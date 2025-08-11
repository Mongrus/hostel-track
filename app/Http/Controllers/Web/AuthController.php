<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthServiceInterface $auth)
    {
    }

    public function show()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $p = $request->payload();

        try {
            $this->auth->loginSession($p['email'], $p['password'], $p['remember']);
            return redirect()->intended(route('dashboard'));
        } catch (AuthenticationException $e) {
            return back()
                ->withErrors(['email' => 'Неверный email или пароль'])
                ->onlyInput('email');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
