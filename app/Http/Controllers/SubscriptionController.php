<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use App\Services\ChapaService;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    protected $chapaService;

    public function __construct(ChapaService $chapaService)
    {
        $this->chapaService = $chapaService;
    }

    public function showSubscriptionForm()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();

        return Inertia::render('Subscriptions/Index', [
            'plans' => $plans,
        ]);
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();

        if ($user->type !== 'seller') {
            return back()->with('error', 'Only sellers can subscribe.');
        }

        // Get the selected subscription plan
        $plan = $request->input('plan');

        // Get the plan details from the database
        $plan = SubscriptionPlan::find($plan);

        if (!$plan) {
            return back()->with('error', 'Invalid subscription plan selected.');
        }

        $amount = $plan->amount;
        $currency = $plan->currency;
        $txRef = 'TX' . uniqid();

        $returnUrl = route('chapa.return', [
            'subscriptionPlan' => $plan->id,
            'transactionId' => $txRef,
        ]);

        $response = $this->chapaService->initializePayment($amount, $currency, $user->email, $user->name, $user->phone_number, $txRef, $returnUrl);

        if ($response && $response['status'] === 'success') {

            Subscription::create([
                'seller_id' => $user->id,
                'subscription_plan_id' => $plan->id,
                'status' => 'pending',
                'tx_ref' => $txRef,
            ]);

            return Inertia::location($response['data']['checkout_url']);
        }

        return back()->with('error', 'Something went wrong. Please try again.');
    }

    public function return(string $transactionId, SubscriptionPlan $subscriptionPlan)
    {
        if (!$transactionId) {
            return redirect()->route('cars.index')->with('error', 'Payment verification failed. Missing transaction reference.');
        }

        $response = $this->chapaService->verifyPayment($transactionId);

        if ($response && $response['status'] === 'success') {
            $subscription = Subscription::where('tx_ref', $transactionId)->first();
            if ($subscription) {
                $subscription->update([
                    'status' => 'active',
                    'expires_at' => now()->addDays($subscriptionPlan->duration_in_days),
                ]);

                $seller = Auth::user()->seller;
                $seller->subscription_ends_at = now()->addDays($subscriptionPlan->duration_in_days);
                $seller->available_posts = $subscriptionPlan->max_posts;
                $seller->save();

                return redirect()->route('cars.index')->with('success', 'Subscription activated successfully!');
            } else {
                return redirect()->route('cars.index')->with('error', 'Subscription not found. Please contact support.');
            }
        }

        return redirect()->route('cars.index')->with('error', 'Payment verification failed. Please contact support.');
    }
}
