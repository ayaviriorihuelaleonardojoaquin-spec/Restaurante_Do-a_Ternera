<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = auth()->user();

            // Redirección según rol
            if ($user->rol?->nombre === 'Administrador') {
                return redirect()->route('dashboard');
            } elseif ($user->rol?->nombre === 'Mesero') {
                return redirect()->route('mesero.index');
            } elseif ($user->rol?->nombre === 'Cajero') {
                return redirect()->route('cajero.index');
            } elseif ($user->rol?->nombre === 'Cliente') {
                return redirect()->route('menu.index'); // Clientes van directo al menú
            }

            return redirect()->route('menu.index'); // fallback
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
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

    protected function authenticated(Request $request, $user)
{
    if ($user->rol?->nombre === 'Administrador') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->rol?->nombre === 'Mesero') {
        return redirect()->route('mesero.pedidos.index');
    } elseif ($user->rol?->nombre === 'Cajero') {
        return redirect()->route('cajero.cobros.index');
    } elseif ($user->rol?->nombre === 'Cliente') {  // <- Asegúrate de que coincida exactamente
        return redirect()->route('menu.index');
    }

    return redirect()->route('menu.index'); // fallback
}


}
