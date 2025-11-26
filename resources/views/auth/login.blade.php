@extends('layouts.layout')

@section('title', 'Connexion')

@section('content')
    <div class="login-container">
        <h1>Connexion</h1>        

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="numero">Identifiant</label>
                <input 
                    type="text" 
                    id="numero" 
                    name="numero" 
                    value="{{ old('numero') }}" 
                    required 
                    autofocus
                >

                @if ($errors->any())
                    <div class="error">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                >
            
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <div class="register-link">
            <p>Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
        </div>
    </div>
@endsection