<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>- One | @yield('title', 'Bienvenue')</title>    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    {{-- Masque le header sur les pages de connexion et d'inscription --}}
    @unless (Request::is('login') || Request::is('register')) 
        <header class="main-header">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-university"></i> T-One
                </div>

                <nav class="main-nav">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <span>Accueil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/operations') }}" class="{{ Request::is('operations') ? 'active' : '' }}">
                                <i class="fas fa-exchange-alt"></i>
                                <span>Opérations</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/historique') }}" class="{{ Request::is('historique') ? 'active' : '' }}">
                                <i class="fas fa-history"></i>
                                <span>Historique</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/manage/viewAlerts') }}" class="{{ Request::is('manage/viewAlerts') ? 'active' : '' }}">
                                <i class="fas fa-bell"></i>
                                <span>Alertes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil') }}" class="{{ Request::is('profil') ? 'active' : '' }}">
                                <i class="fas fa-user-circle"></i>
                                <span>Mon Profil</span>
                            </a>
                        </li>
                        @auth
                            <li>
                                {{-- On retire la classe 'logout-button' et on ajoute 'nav-link-button' pour le styler --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link-button">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Déconnexion</span>
                                    </button>
                                </form>
                            </li>
                        @endauth
                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Connexion</span>
                            </a>
                        </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </header>
    @endunless

    <main class="{{ Request::is('login') || Request::is('register') ? 'auth-page-main' : '' }}">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} T-One Bank. Tous droits réservés. <a href="#">Mentions Légales</a> | <a href="#">Contact</a></p>
    </footer>

    @stack('scripts')
</body>

</html>