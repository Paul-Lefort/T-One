<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bienvenue') | Mon Banque</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJd4n0U6UFLs/1h6p0eP3d3n0x0h5b6q6d/Q4q0eB7p3v9qjP8O7N0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-university"></i> Mon Banque
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
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Mon Banque. Tous droits réservés. <a href="#">Mentions Légales</a> | <a href="#">Contact</a></p>
    </footer>

    @stack('scripts')
</body>

</html>