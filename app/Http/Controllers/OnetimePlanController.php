<?php

namespace App\Http\Controllers;

use App\Models\Onetime;
use App\Models\OnetimePlan;
use Illuminate\Http\Request;
use App\Services\ChapaService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OnetimePlanController extends Controller
{
    protected $chapaService;

    public function __construct(ChapaService $chapaService)
    {
        $this->chapaService = $chapaService;
    }

    public function showOnetimePlans()
    {
        $plans = OnetimePlan::where('is_active', true)->get();

        return Inertia::render('OnetimePlans/Index', [
            'plans' => $plans,
        ]);
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();

        if ($user->type !== 'seller') {
            return back()->with('error', 'Only sellers can use this feature.');
        }

        // Get the selected one-time plan
        $planId = $request->input('plan');

        // Get the plan details from the database
        $plan = OnetimePlan::find($planId);

        if (!$plan) {
            return back()->with('error', 'Invalid one-time plan selected.');
        }

        $amount = $plan->amount;
        $currency = $plan->currency;
        $txRef = 'TX' . uniqid();

        $returnUrl = route('chapa.onetime.return', [
            'onetimePlan' => $plan->id,
            'transactionId' => $txRef,
        ]);

        $response = $this->chapaService->initializePayment($amount, $currency, $user->email, $user->name, $user->phone_number, $txRef, $returnUrl);


        if ($response && $response['status'] === 'success') {
            Onetime::create([
                'seller_id' => $user->id,
                'onetime_plan_id' => $plan->id,
                'status' => 'pending',
                'tx_ref' => $txRef,
            ]);

            return Inertia::location($response['data']['checkout_url']);
        }

        return back()->with('error', 'Something went wrong. Please try again.');
    }

    public function return(string $transactionId, OnetimePlan $onetimePlan)
    {
        if (!$transactionId) {
            return redirect()->route('cars.index')->with('error', 'Payment verification failed. Missing transaction reference.');
        }

        $response = $this->chapaService->verifyPayment($transactionId);

        if ($response && $response['status'] === 'success') {
            // Handle successful payment
            $onetime = Onetime::where('tx_ref', $transactionId)->first();
            if ($onetime) {
                $onetime->update([
                    'status' => 'paid',
                    'expires_at' => now()->addDays($onetimePlan->validity_days),
                ]);

                $seller = Auth::user()->seller;
                $seller->onetime_plan_ends_at = now()->addDays($onetimePlan->validity_days);
                $seller->available_posts = $onetimePlan->max_posts;
                $seller->save();

                return redirect()->route('cars.index')->with('success', 'Payment successful!');
            }
            else {
                return redirect()->route('cars.index')->with('error', 'Payment verification failed. Please contact support.');
            }
        }

        return redirect()->route('cars.index')->with('error', 'Payment verification failed. Please contact support.');
    }
}
