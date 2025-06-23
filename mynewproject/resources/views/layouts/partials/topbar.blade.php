<header class="topbar">
    <div class="topbar-left">
        <button class="mobile-menu-toggle" id="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="page-title">
            <h1>@yield('page-title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="topbar-center">
        <div class="search-container">
            <form class="search-form">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Rechercher formations, candidatures...">
                    <button type="button" class="search-filter-btn" data-bs-toggle="dropdown">
                        <i class="fas fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu search-filters">
                        <li><a class="dropdown-item" href="#" data-filter="formations">Formations</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="candidatures">Candidatures</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="entreprises">Entreprises</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="formateurs">Formateurs</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="topbar-right">
        <!-- Notifications -->
        <div class="topbar-item dropdown">
            <button class="topbar-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                <div class="dropdown-header">
                    <h6>Notifications</h6>
                    <span class="badge bg-primary">3 nouvelles</span>
                </div>
                <div class="notification-list">
                    <a href="#" class="notification-item unread">
                        <div class="notification-icon bg-primary">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">Nouvelle candidature</div>
                            <div class="notification-text">Jean Dupont a postulé pour la formation Web</div>
                            <div class="notification-time">Il y a 5 minutes</div>
                        </div>
                    </a>
                    <a href="#" class="notification-item unread">
                        <div class="notification-icon bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">Formation validée</div>
                            <div class="notification-text">La formation "React.js" a été approuvée</div>
                            <div class="notification-time">Il y a 1 heure</div>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">Date limite proche</div>
                            <div class="notification-text">Les inscriptions ferment dans 2 jours</div>
                            <div class="notification-time">Il y a 3 heures</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="#" class="btn btn-sm btn-outline-primary w-100">Voir toutes les notifications</a>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="topbar-item dropdown">
            <button class="topbar-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-envelope"></i>
                <span class="notification-badge">2</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end message-dropdown">
                <div class="dropdown-header">
                    <h6>Messages</h6>
                    <span class="badge bg-success">2 nouveaux</span>
                </div>
                <div class="message-list">
                    <a href="#" class="message-item unread">
                        <div class="message-avatar">
                            <img src="https://via.placeholder.com/40" alt="Avatar">
                        </div>
                        <div class="message-content">
                            <div class="message-title">Marie Martin</div>
                            <div class="message-text">Question sur la formation...</div>
                            <div class="message-time">Il y a 10 minutes</div>
                        </div>
                    </a>
                    <a href="#" class="message-item unread">
                        <div class="message-avatar">
                            <img src="https://via.placeholder.com/40" alt="Avatar">
                        </div>
                        <div class="message-content">
                            <div class="message-title">Pierre Dubois</div>
                            <div class="message-text">Demande d'information...</div>
                            <div class="message-time">Il y a 30 minutes</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="#" class="btn btn-sm btn-outline-success w-100">Voir tous les messages</a>
                </div>
            </div>
        </div>

        <!-- User Menu -->
        <div class="topbar-item dropdown">
            <button class="user-menu-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">
                    @if(auth()->user()->profile_image)
                        <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile">
                    @else
                        <div class="avatar-placeholder">
                            {{ substr(auth()->user()->prenom, 0, 1) }}{{ substr(auth()->user()->nom, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                    <div class="user-role">{{ auth()->user()->role->nom }}</div>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <div class="dropdown-menu dropdown-menu-end user-dropdown">
                <div class="user-dropdown-header">
                    <div class="user-avatar-large">
                        @if(auth()->user()->profile_image)
                            <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile">
                        @else
                            <div class="avatar-placeholder-large">
                                {{ substr(auth()->user()->prenom, 0, 1) }}{{ substr(auth()->user()->nom, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                        <div class="user-email">{{ auth()->user()->email }}</div>
                        <div class="user-role">{{ auth()->user()->role->nom }}</div>
                    </div>
                </div>
                
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="{{ route('dashboard.profile') }}">
                    <i class="fas fa-user me-2"></i>Mon Profil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cog me-2"></i>Paramètres
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-question-circle me-2"></i>Aide
                </a>
                
                <div class="dropdown-divider"></div>
                
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
