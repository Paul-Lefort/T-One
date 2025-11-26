<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Générer un numéro unique automatiquement
        $numero = $this->generateUniqueNumero(10);

        $user = User::create([
            'name' => $validated['name'],
            'numero' => $numero,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        session()->put('id', $user->id);
        session()->put('name', $user->name);
        // On retourne le numéro généré en flash pour l'afficher côté client si besoin
        return redirect('/')->with('generated_numero', $numero);
    }

    /**
     * Génère un numéro numérique unique pour l'utilisateur
     * @param int $length
     * @return string
     */
    private function generateUniqueNumero(int $length = 10): string
    {
        // Simple boucle pour garantir l'unicité. Ajustez la longueur si nécessaire.
        do {
            $numero = '';
            for ($i = 0; $i < $length; $i++) {
                $numero .= mt_rand(0, 9);
            }

            // En dernier recours, journaliser pour debug
            if (User::where('numero', $numero)->exists()) {
                Log::debug('Collision numero generated: ' . $numero);
            }
        } while (User::where('numero', $numero)->exists());

        return $numero;
    }
}
