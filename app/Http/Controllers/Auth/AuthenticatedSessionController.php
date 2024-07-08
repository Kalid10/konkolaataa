<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Determine if the login field is an email or phone number
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // Attempt to authenticate the user
        $credentials = [$field => $login, 'password' => $request->input('password')];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        $userType = Auth::user()->type;

        return match ($userType) {
           User::TYPE_ADMIN => redirect()->intended('/admin'),
            User::TYPE_BUYER => redirect()->intended('/car'),
            User::TYPE_SELLER => redirect()->intended('/seller'),
            default => redirect()->intended('/'),
        };
 }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Obtain the user information from Google.
     *
     * @return RedirectResponse | Response
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();


        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {

            return Inertia::render('Auth/Socialite', [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ]);
        }

        // Log the user in
        Auth::login($user);

        return redirect()->route('cars.index');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return
     */
    public function findOrCreateUser($googleUser)
    {
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {

            return Inertia::render('Auth/Socialite', [
                'user' => $googleUser,
            ]);
        }

        return $user;
    }
}
