<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function login(): View {
        return view('auth.login');
    }


    public function register(): View {
        return view('auth.register');
    }

    public function processLogin(Request $request, string $email, string $password): bool {

        $loginResult = Auth::attempt(['email' => $email, 'password' => $password]);

        if ($loginResult) {
            $request->session()->regenerate();
        }

        return $loginResult;
    }


    public function handleLogin(Request $request): RedirectResponse|View {
        $validated = $request->validate([
            'email' => 'required|exists:users,email|max:200',
            'password' => 'required',
        ]);


        if ($this->processLogin($request, $validated['email'], $validated['password'])) {
 
            return redirect()->route('view.home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function handleRegister(Request $request): RedirectResponse {

        $validated = $request->validate([
            'email' => 'required|unique:users|max:20',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $userData = [
            'name'                      => $request->input('name'),
            'email'                     => $request->input('email'),
            'password'                  => $request->input('password'),
            'password_confirmation'     => $request->input('password_confirmation')
        ];

        User::create($userData);

        if ($this->processLogin($request, $userData['email'], $userData['password'])) {
            return redirect()->intended('view.home');
        }

        return redirect()->route('view.home');
    }


    public function handleLogout(Request $request): RedirectResponse {

        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('view.home');

    }
}
