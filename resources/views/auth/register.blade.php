@extends('layouts.layout') 

@section('title', 'Inscription')

@section('content')
    <div class="login-container">
        <h1>Inscription</h1>
        
        {{-- Affichage global des erreurs (si vous en avez dans votre contrôleur) --}}
        @if ($errors->any() && !isset($errors->all()[0]))
            <div class="error">
                <p>Veuillez corriger les erreurs ci-dessous.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nom</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    class="@error('name') is-invalid @enderror" {{-- Ajout de classe pour le style en cas d'erreur --}}
                >
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            {{-- L'email n'est pas requis. Le numéro de compte sera généré automatiquement. --}}

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    class="@error('password') is-invalid @enderror"
                >
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                >
            </div>

            <button type="submit">S'inscrire</button>
        </form>

        <div class="register-link">
            <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
        </div>
    </div>
@endsection