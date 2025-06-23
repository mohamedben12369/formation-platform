<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard.index') }}">
            <i class="fas fa-graduation-cap me-2"></i>
            Formation
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('dashboard*') ? ' active' : '' }}" href="#collapseAxes">
                      Axes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('domaines*') ? ' active' : '' }}" href="#collapseDomaines">
                         Domaines
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('sous-domaines*') ? ' active' : '' }}" href="#collapseSousDomaines">
                        Sous-Domaines
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('themes*') ? ' active' : '' }}" href="#collapseThemes">
                 Thèmes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('questions*') ? ' active' : '' }}" href="#collapseQuestions">
                        </i> Questions
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                       {{ Auth::user()->name ?? 'User' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-1"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-1"></i> Profile</a>
                                                        <li><hr class="dropdown-divider"></li>
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="header-spacer" style="margin-top: 76px;"></div>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3">Tableau de Bord</h1>
            <p class="text-center text-muted">Gérez vos données efficacement et facilement.</p>
        </div>
    </div>
</div>
