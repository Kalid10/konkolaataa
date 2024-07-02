<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'phone_number' => 'required|regex:/^\+251[79][0-9]{8}$/|max:13|unique:users,phone_number',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => 'required|string|in:admin,buyer,seller',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        match ($request->type) {
            'admin' => $user = Admin::create(['user_id' => $user->id]),
            'buyer' => $user = Buyer::create(['user_id' => $user->id, 'balance' => env('INITIAL_PLAYER_BONUS_BALANCE', 0)]),
            'seller' => $user = Seller::create(['user_id' => $user->id]),
        };

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('cars.index')->with('success', 'User registered successfully.');
    }
}
