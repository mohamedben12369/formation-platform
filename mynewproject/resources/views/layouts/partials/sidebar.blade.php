<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap brand-icon"></i>
            <span class="brand-text">FormationPro</span>
        </div>
        <button class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="sidebar-content">
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <!-- Formations -->
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu {{ request()->routeIs('dashboard.formations.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#formations-menu">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">Formations</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse {{ request()->routeIs('dashboard.formations.*') ? 'show' : '' }}" id="formations-menu">
                        <li><a href="{{ route('dashboard.formations.index') }}" class="submenu-link">Toutes les formations</a></li>
                        <li><a href="{{ route('dashboard.formations.create') }}" class="submenu-link">Créer une formation</a></li>
                    </ul>
                </li>

                <!-- Thèmes de Formation -->
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu {{ request()->routeIs('dashboard.theme-formations.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#themes-menu">
                        <i class="fas fa-tags nav-icon"></i>
                        <span class="nav-text">Thèmes</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse {{ request()->routeIs('dashboard.theme-formations.*') ? 'show' : '' }}" id="themes-menu">
                        <li><a href="{{ route('dashboard.theme-formations.index') }}" class="submenu-link">Tous les thèmes</a></li>
                        <li><a href="{{ route('dashboard.theme-formations.create') }}" class="submenu-link">Créer un thème</a></li>
                    </ul>
                </li>

                <!-- Candidatures -->
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu {{ request()->routeIs('dashboard.candidatures.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#candidatures-menu">
                        <i class="fas fa-users nav-icon"></i>
                        <span class="nav-text">Candidatures</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse {{ request()->routeIs('dashboard.candidatures.*') ? 'show' : '' }}" id="candidatures-menu">
                        <li><a href="{{ route('dashboard.candidatures.index') }}" class="submenu-link">Toutes les candidatures</a></li>
                        <li><a href="{{ route('dashboard.type-documents.index') }}" class="submenu-link">Types de documents</a></li>
                    </ul>
                </li>

                <!-- Entreprises -->
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu {{ request()->routeIs('dashboard.entreprises.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#entreprises-menu">
                        <i class="fas fa-building nav-icon"></i>
                        <span class="nav-text">Entreprises</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse {{ request()->routeIs('dashboard.entreprises.*') ? 'show' : '' }}" id="entreprises-menu">
                        <li><a href="{{ route('dashboard.entreprises.index') }}" class="submenu-link">Toutes les entreprises</a></li>
                        <li><a href="{{ route('dashboard.entreprises.create') }}" class="submenu-link">Créer une entreprise</a></li>
                    </ul>
                </li>

                <!-- Formateurs -->
                @if(auth()->user()->role->nom === 'Admin' || auth()->user()->role->nom === 'Formateur')
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu {{ request()->routeIs('dashboard.formateurs.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#formateurs-menu">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <span class="nav-text">Formateurs</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse {{ request()->routeIs('dashboard.formateurs.*') ? 'show' : '' }}" id="formateurs-menu">
                        <li><a href="{{ route('dashboard.formateurs.index') }}" class="submenu-link">Tous les formateurs</a></li>
                        <li><a href="{{ route('dashboard.formateurs.create') }}" class="submenu-link">Ajouter un formateur</a></li>
                    </ul>
                </li>
                @endif

                <!-- Rapports -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.reports') }}" class="nav-link {{ request()->routeIs('dashboard.reports') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <span class="nav-text">Rapports</span>
                    </a>
                </li>

                <!-- Paramètres -->
                <li class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-bs-toggle="collapse" data-bs-target="#settings-menu">
                        <i class="fas fa-cog nav-icon"></i>
                        <span class="nav-text">Paramètres</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu collapse" id="settings-menu">
                        <li><a href="{{ route('dashboard.profile') }}" class="submenu-link">Mon Profil</a></li>
                        <li><a href="#" class="submenu-link">Préférences</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                @if(auth()->user()->profile_image)
                    <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div class="user-details">
                <div class="user-name">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                <div class="user-role">{{ auth()->user()->role->nom }}</div>
            </div>
        </div>
        <div class="sidebar-actions">
            <button class="btn-theme-toggle" id="theme-toggle" title="Changer le thème">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </div>
</aside>
