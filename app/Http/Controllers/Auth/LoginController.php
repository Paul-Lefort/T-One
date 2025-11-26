<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function showLoginForm(){

        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'numero' => 'required|string',
            'password' => 'required|string',
        ]);

        // Exiger que le status de l'utilisateur soit égal à 1
        $credentialsWithStatus = array_merge($credentials, ['status' => 1]);

        if (Auth::attempt($credentialsWithStatus)) {
            $request->session()->regenerate();
            session()->put('id', Auth::user()->id);
            session()->put('name', Auth::user()->name);
            return redirect()->intended('/');
        }

        // Si l'auth échoue, vérifier si l'utilisateur existe mais est inactif
        $user = User::where('numero', $credentials['numero'])->first();
        if ($user && $user->status != 1) {
            return back()->withErrors([
                'numero' => 'Votre compte est inactif. Merci de contacter le support.',
            ])->onlyInput('numero');
        }

        return back()->withErrors([
            'numero' => "L'identifiant ou le mot de passe est incorrect.",
        ])->onlyInput('numero');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
