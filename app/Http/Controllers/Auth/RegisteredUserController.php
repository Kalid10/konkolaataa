<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function socialite(): Response
    {
        return Inertia::render('Auth/Socialite');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {


        $user = User::updateOrCreate([
            'phone_number' => $request->phone_number,
        ],[
            'name' => ucfirst($request->name),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        match ($request->type) {
            'admin' => Admin::create(['user_id' => $user->id]),
            'buyer' => Buyer::create(['user_id' => $user->id]),
            'seller' => Seller::create(['user_id' => $user->id]),
        };

        Auth::login($user);

        return redirect()->route('cars.index')->with('success', 'User registered successfully.');
    }
}
