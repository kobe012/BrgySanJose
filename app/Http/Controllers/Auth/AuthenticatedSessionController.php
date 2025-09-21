<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create()
    {
        return Inertia::render('LogIn');
    }

    public function GoogleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function GoogleCallback()
    {
        $gUser = Socialite::driver("google")->stateless()->user();
        dd($gUser);
        // Since the User model doesn't have email field,
        // we'll use the Google email as username
        $googleEmail = $gUser->getEmail();

        // Find or create user based on Google email as username
        $user = User::where('username', $googleEmail)->first();

        if (!$user) {
            // Create new user if doesn't exist
            $user = User::create([
                'name' => $gUser->name,
                'email' =>  $googleEmail,
                'username' => $googleEmail,
                'role' => 'Resident',
            ]);
        }

        UserData::updateOrCreate(
            ['user_id' => $user->id],
            ['information' => $gUser->user]
        );

        Auth::login($user);

        // Redirect to dashboard or intended page
        return redirect()->intended('/');
    }
    public function residentCreate()
    {
        return inertia('ResidentLogin');
    }

    public function residentStore(Request $request)
    {
        // You can use the same logic as your admin store, or customize as needed
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // or wherever you want residents to go
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Handles auth & remember me logic
        $request->authenticate();

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Flash a success message to be displayed in Vue
        $request->session()->flash('success', 'Welcome back!');

        // Redirect to intended page or dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Logout and destroy session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(route('home', absolute: true));
    }
}
