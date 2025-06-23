<nav class="navbar navbar-expand-lg navbar-dark position-sticky top-0" style="z-index: 1000; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard.index') }}">
            <i class="fas fa-graduation-cap me-2"></i>
            {{ config('app.name', 'Formation') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-home me-1"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.statistiques-generales') ? 'active' : '' }}" href="{{ route('dashboard.statistiques-generales') }}">
                            <i class="fas fa-chart-line me-1"></i> Statistiques
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cogs me-1"></i> Gestion
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.axes.*') ? 'active' : '' }}" href="{{ route('dashboard.axes.index') }}">
                                    <i class="fas fa-project-diagram me-1"></i> Axes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.domaines.*') ? 'active' : '' }}" href="{{ route('dashboard.domaines.index') }}">
                                    <i class="fas fa-sitemap me-1"></i> Domaines
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.sous-domaines.*') ? 'active' : '' }}" href="{{ route('dashboard.sous-domaines.index') }}">
                                    <i class="fas fa-code-branch me-1"></i> Sous-Domaines
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.theme-formations.*') ? 'active' : '' }}" href="{{ route('dashboard.theme-formations.index') }}">
                                    <i class="fas fa-book-open me-1"></i> Thèmes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.formations.*') ? 'active' : '' }}" href="{{ route('dashboard.formations.index') }}">
                                    <i class="fas fa-chalkboard-teacher me-1"></i> Formations
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.statut-formations.*') ? 'active' : '' }}" href="{{ route('dashboard.statut-formations.index') }}">
                                    <i class="fas fa-flag me-1"></i> Statuts
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-university me-1"></i> Académique
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.etablissements.*') ? 'active' : '' }}" href="{{ route('dashboard.etablissements.index') }}">
                                    <i class="fas fa-building me-1"></i> Établissements
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.type-diplomes.*') ? 'active' : '' }}" href="{{ route('dashboard.type-diplomes.index') }}">
                                    <i class="fas fa-graduation-cap me-1"></i> Types de Diplômes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('dashboard.niveaux.*') ? 'active' : '' }}" href="{{ route('dashboard.niveaux.index') }}">
                                    <i class="fas fa-layer-group me-1"></i> Niveaux
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
            
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </a>
                    </li>
                @endguest
                @auth                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2" style="font-size: 32px;"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-1"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@push('styles')
<style>
    .navbar {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.5rem;
    }

    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        transform: translateY(-2px);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgb(34 39 46 / 15%);
        border-radius: 0.5rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .dropdown-item.active {
        background-color: #2563eb;
        color: white;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: rgba(255,255,255,0.9);
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        color: #ffffff;
    }
</style>
@endpush
