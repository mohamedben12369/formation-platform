<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        /* Navbar styles modernes */
        .modern-navbar {
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            left: 0 !important;
            background: linear-gradient(135deg, #1e1e2e 0%, #2a2a40 100%) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            z-index: 1100;
            padding: 0.75rem 1rem;
            height: 70px;
        }

        .navbar-brand-modern {
            display: flex;
            align-items: center;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .navbar-brand-modern:hover {
            color: #667eea !important;
            transform: scale(1.05);
        }

        .navbar-brand-modern i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            padding: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .navbar-brand-modern span {
            letter-spacing: 0.5px;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle-modern {
            background: rgba(255,255,255,0.1) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            color: #ffffff !important;
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
        }

        .menu-toggle-modern:hover {
            background: rgba(255,255,255,0.2) !important;
            transform: scale(1.05);
            color: #ffffff !important;
        }

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: rgba(30, 30, 46, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 15px;
            min-width: 200px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1200;
        }

        .user-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 15px;
            width: 12px;
            height: 12px;
            background: rgba(30, 30, 46, 0.95);
            border: 1px solid rgba(255,255,255,0.1);
            border-bottom: none;
            border-right: none;
            transform: rotate(45deg);
        }

        .dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #ffffff;
        }

        .dropdown-header h6 {
            margin: 0;
            font-weight: 600;
        }

        .dropdown-header small {
            color: #b8bcc8;
        }

        .dropdown-item-modern {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #b8bcc8;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
        }

        .dropdown-item-modern:hover {
            background: rgba(255,255,255,0.05);
            color: #ffffff;
            transform: translateX(5px);
        }

        .dropdown-item-modern i {
            width: 20px;
            margin-right: 0.75rem;
            text-align: center;
        }

        .dropdown-divider-modern {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 0.5rem 0;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: #ef4444;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            border: 2px solid #1e1e2e;
        }

        .nav-item-modern {
            position: relative;
        }

        .nav-btn-modern {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-btn-modern:hover {
            background: rgba(255,255,255,0.2);
            color: #ffffff;
            transform: scale(1.05);
        }

        /* Système de notifications */
        .notifications-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: rgba(30, 30, 46, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 15px;
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1200;
        }

        .notifications-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notifications-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 15px;
            width: 12px;
            height: 12px;
            background: rgba(30, 30, 46, 0.95);
            border: 1px solid rgba(255,255,255,0.1);
            border-bottom: none;
            border-right: none;
            transform: rotate(45deg);
        }

        .notifications-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-header h6 {
            margin: 0;
            color: #ffffff;
            font-weight: 600;
        }

        .mark-all-read {
            background: none;
            border: none;
            color: #667eea;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .mark-all-read:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #764ba2;
        }

        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .notification-item:hover {
            background: rgba(255,255,255,0.05);
        }

        .notification-item.unread {
            background: rgba(102, 126, 234, 0.1);
            border-left: 3px solid #667eea;
        }

        .notification-item.unread::before {
            content: '';
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 8px;
            height: 8px;
            background: #667eea;
            border-radius: 50%;
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .notification-icon.info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .notification-icon.success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .notification-icon.warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .notification-icon.error {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0 0 0.25rem 0;
        }

        .notification-message {
            color: #b8bcc8;
            font-size: 0.8rem;
            line-height: 1.4;
            margin: 0 0 0.5rem 0;
        }

        .notification-time {
            color: #6c757d;
            font-size: 0.7rem;
        }

        .notifications-empty {
            padding: 2rem;
            text-align: center;
            color: #6c757d;
        }

        .notifications-empty i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            opacity: 0.5;
        }

        .notifications-footer {
            padding: 0.75rem;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .view-all-notifications {
            color: #667eea;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .view-all-notifications:hover {
            color: #764ba2;
        }

        /* Scrollbar pour notifications */
        .notifications-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .notifications-dropdown::-webkit-scrollbar-track {
            background: transparent;
        }

        .notifications-dropdown::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .notifications-dropdown::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Sidebar styles modernes */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            width: 280px;
            padding: 0;
            background: linear-gradient(180deg, #1e1e2e 0%, #2a2a40 50%, #1e1e2e 100%);
            border-right: 1px solid rgba(255,255,255,0.1);
            overflow-y: auto;
            z-index: 1000;
            backdrop-filter: blur(20px);
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }

        .sidebar-header {
            padding: 2rem 1.5rem 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, transparent 100%);
        }

        .sidebar-header h5 {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
            text-align: center;
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            color: #b8bcc8;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-weight: 500;
            border: 1px solid transparent;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .sidebar-link:hover {
            color: #ffffff;
            transform: translateX(5px);
            border-color: rgba(255,255,255,0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .sidebar-link:hover::before {
            opacity: 1;
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            transform: translateX(5px);
        }

        .sidebar-link.active::before {
            opacity: 0;
        }
        
        .sidebar-link i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        .sidebar-link span {
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        /* Groupes de navigation */
        .nav-group {
            margin-bottom: 2rem;
        }

        .nav-group-title {
            color: #6c757d;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 1.25rem 0.5rem 1.25rem;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 0.5rem;
        }

        /* Effets pour les icônes spécifiques */
        .sidebar-link[href*="dashboard"] i { color: #667eea; }
        .sidebar-link[href*="axes"] i { color: #764ba2; }
        .sidebar-link[href*="domaines"] i { color: #4facfe; }
        .sidebar-link[href*="sous-domaines"] i { color: #43e97b; }
        .sidebar-link[href*="theme"] i { color: #fa709a; }
        .sidebar-link[href*="type-formations"] i { color: #ff9500; }
        .sidebar-link[href*="formations"] i { color: #ffc700; }
        .sidebar-link[href*="type-diplomes"] i { color: #667eea; }
        .sidebar-link[href*="etablissements"] i { color: #764ba2; }
        .sidebar-link[href*="statut"] i { color: #4facfe; }
        .sidebar-link[href*="niveaux"] i { color: #43e97b; }
        .sidebar-link[href*="type-experiences"] i { color: #fa709a; }
        .sidebar-link[href*="entreprises"] i { color: #ffc700; }
        .sidebar-link[href*="roles"] i { color: #9333ea; }

        .sidebar-link.active i {
            color: #ffffff !important;
        }

        /* Main content styles */
        .main-content {
            margin-left: 280px;
            padding: 0;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .sidebar.show {
                left: 0;
                box-shadow: 10px 0 30px rgba(0,0,0,0.3);
            }
            
            .main-content {
                margin-left: 0;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }

        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --info-color: #0ea5e9;
            --warning-color: #eab308;
            --danger-color: #ef4444;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        /* Card Styles */
        .card {
            background: #ffffff;
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e5e7eb;
            padding: 1.25rem;
            font-weight: 600;
        }

        .card-title {
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Button Styles */
        .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn i {
            font-size: 1rem;
        }

        /* Form Styles */
        .form-control {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 0.625rem 1rem;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        /* Profile-specific Styles */
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-background {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
        }

        .profile-section {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* List Styles */
        .list-group-item {
            border: none;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
        }

        /* Custom Utilities */
        .text-muted {
            color: #64748b !important;
        }

        .border-bottom {
            border-bottom-color: #e5e7eb !important;
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>

    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="min-height:100vh;">
    @php
        // Définir une image de fond différente selon la page
        $bgImages = [
            'axes' => asset('images/bg-axes.jpg'),
            'domaines' => asset('images/bg-domaines.jpg'),
            'niveaux' => asset('images/bg-niveaux.jpg'),
            'sous-domaines' => asset('images/bg-sous-domaines.jpg'),
            // Ajoutez d'autres pages ici
        ];
        $current = request()->segment(1);
        $bgImage = $bgImages[$current] ?? asset('images/bg-default.jpg');
    @endphp
    <div class="min-h-screen dashboard-bg">
        <!-- Navigation principale moderne -->
        <nav class="modern-navbar">
            <div class="container-fluid">
                <a class="navbar-brand-modern" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Formation Manager</span>
                </a>
                
                <div class="navbar-actions">
                    <!-- Notifications -->
                    <div class="nav-item-modern">
                        <button class="nav-btn-modern" id="notificationsBtn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notificationCount">3</span>
                        </button>
                        <div class="notifications-dropdown" id="notificationsDropdown">
                            <div class="notifications-header">
                                <h6>Notifications</h6>
                                <button class="mark-all-read" id="markAllRead">Marquer tout comme lu</button>
                            </div>
                            <div id="notificationsList">
                                <!-- Les notifications seront chargées ici -->
                            </div>
                            <div class="notifications-footer">
                                <a href="#" class="view-all-notifications">Voir toutes les notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- Menu utilisateur -->
                    <div class="user-menu">
                        <div class="user-avatar" id="userMenuBtn">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <h6>{{ Auth::user()->name ?? 'Utilisateur' }}</h6>
                                <small>{{ Auth::user()->email ?? 'admin@formation.com' }}</small>
                            </div>
                            <a href="#" class="dropdown-item-modern">
                                <i class="fas fa-user-circle"></i>
                                <span>Mon Profil</span>
                            </a>
                            <a href="#" class="dropdown-item-modern">
                                <i class="fas fa-cog"></i>
                                <span>Paramètres</span>
                            </a>
                            <a href="#" class="dropdown-item-modern">
                                <i class="fas fa-question-circle"></i>
                                <span>Aide</span>
                            </a>
                            <div class="dropdown-divider-modern"></div>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item-modern">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Toggle sidebar -->
                    <button class="menu-toggle-modern" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h5>Navigation</h5>
            </div>
            <nav class="sidebar-nav">
                <!-- Tableau de bord -->
                <div class="nav-group">
                    <div class="nav-group-title">Accueil</div>
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                </div>

                <!-- Gestion des formations -->
                <div class="nav-group">
                    <div class="nav-group-title">Formations</div>
                    <a href="{{ route('dashboard.formations.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.formations.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Formations</span>
                    </a>
                    <a href="{{ route('dashboard.axes.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.axes.*') ? 'active' : '' }}">
                        <i class="fas fa-project-diagram"></i>
                        <span>Axes</span>
                    </a>
                    <a href="{{ route('dashboard.domaines.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.domaines.*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap"></i>
                        <span>Domaines</span>
                    </a>
                    <a href="{{ route('dashboard.sous-domaines.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.sous-domaines.*') ? 'active' : '' }}">
                        <i class="fas fa-code-branch"></i>
                        <span>Sous-domaines</span>
                    </a>
                    <a href="{{ route('dashboard.theme-formations.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.theme-formations.*') ? 'active' : '' }}">
                        <i class="fas fa-book-open"></i>
                        <span>Thèmes</span>
                    </a>
                    <a href="{{ route('dashboard.type-formations.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.type-formations.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span>Types de Formation</span>
                    </a>
                    <a href="{{ route('dashboard.statut-formations.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.statut-formations.*') ? 'active' : '' }}">
                        <i class="fas fa-flag"></i>
                        <span>Statuts Formation</span>
                    </a>
                </div>

                <!-- Gestion académique -->
                <div class="nav-group">
                    <div class="nav-group-title">Académique</div>
                    <a href="{{ route('dashboard.type-diplomes.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.type-diplomes.*') ? 'active' : '' }}">
                        <i class="fas fa-scroll"></i>
                        <span>Types de Diplômes</span>
                    </a>
                    <a href="{{ route('dashboard.etablissements.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.etablissements.*') ? 'active' : '' }}">
                        <i class="fas fa-university"></i>
                        <span>Établissements</span>
                    </a>
                    <a href="{{ route('dashboard.niveaux.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.niveaux.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Niveaux</span>
                    </a>
                </div>

                <!-- Gestion professionnelle -->
                <div class="nav-group">
                    <div class="nav-group-title">Professionnel</div>
                    <a href="{{ route('dashboard.type-experiences.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.type-experiences.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase"></i>
                        <span>Types d'Expérience</span>
                    </a>
                    <a href="{{ route('dashboard.entreprises.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.entreprises.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span>Entreprises</span>
                    </a>
                </div>

                <!-- Administration -->
                <div class="nav-group">
                    <div class="nav-group-title">Administration</div>
                    <a href="{{ route('dashboard.roles.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                        <i class="fas fa-user-shield"></i>
                        <span>Rôles</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Overlay pour mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Contenu principal -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        console.log('Script loaded, jQuery version:', $.fn.jquery);
        
        $(document).ready(function() {
            console.log('Document ready, initializing...');
            
            // Vérifier que les éléments existent
            console.log('Notifications button exists:', $('#notificationsBtn').length > 0);
            console.log('Notifications dropdown exists:', $('#notificationsDropdown').length > 0);
            
            // Initialize Select2
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2({
                    theme: 'bootstrap-5'
                });
            }

            // Initialize all tooltips
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });

                // Initialize all popovers
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                });
            }

            // Toggle sidebar moderne
            $('#toggleSidebar').on('click', function(e) {
                e.preventDefault();
                console.log('Toggle sidebar clicked');
                $('.sidebar').toggleClass('show');
                $('#sidebarOverlay').toggleClass('show');
            });

            // Menu utilisateur
            $('#userMenuBtn').on('click', function(e) {
                e.stopPropagation();
                console.log('User menu clicked');
                $('#userDropdown').toggleClass('show');
            });

            // Fermer menu utilisateur en cliquant ailleurs
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.user-menu').length) {
                    $('#userDropdown').removeClass('show');
                }
            });

            // Notifications système - VERSION CORRIGÉE
            $('#notificationsBtn').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Notifications button clicked!');
                
                const dropdown = $('#notificationsDropdown');
                console.log('Dropdown element found:', dropdown.length > 0);
                
                dropdown.toggleClass('show');
                console.log('Dropdown has show class:', dropdown.hasClass('show'));
                
                if (dropdown.hasClass('show')) {
                    loadNotifications();
                }
            });

            // Fermer notifications en cliquant ailleurs
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.nav-item-modern').length) {
                    $('#notificationsDropdown').removeClass('show');
                }
            });

            // Marquer toutes les notifications comme lues
            $(document).on('click', '#markAllRead', function(e) {
                e.preventDefault();
                console.log('Mark all read clicked');
                markAllNotificationsAsRead();
            });

            // Fermer sidebar avec overlay
            $('#sidebarOverlay').on('click', function() {
                $('.sidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#toggleSidebar').length) {
                        $('.sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }
                }
            });

            // Animation pour les liens de navigation
            $('.sidebar-link').on('mouseenter', function() {
                $(this).find('i').addClass('fa-pulse');
            }).on('mouseleave', function() {
                $(this).find('i').removeClass('fa-pulse');
            });

            // Smooth scroll pour les ancres
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Charger les notifications au démarrage
            console.log('Loading initial notifications...');
            setTimeout(function() {
                loadNotifications();
            }, 500);
        });

        // Variables globales
        let notificationsData = [];

        // Fonction pour charger les notifications
        function loadNotifications() {
            console.log('LoadNotifications called');
            
            // Simulations de notifications (remplacez par un appel AJAX réel)
            notificationsData = [
                {
                    id: 1,
                    type: 'info',
                    title: 'Nouvelle formation ajoutée',
                    message: 'La formation "Développement Web" a été ajoutée au catalogue.',
                    time: 'Il y a 5 minutes',
                    unread: true,
                    icon: 'fa-graduation-cap'
                },
                {
                    id: 2,
                    type: 'success',
                    title: 'Candidature acceptée',
                    message: 'Une nouvelle candidature a été acceptée pour la formation Python.',
                    time: 'Il y a 15 minutes',
                    unread: true,
                    icon: 'fa-check-circle'
                },
                {
                    id: 3,
                    type: 'warning',
                    title: 'Formation à valider',
                    message: '5 candidatures sont en attente de validation.',
                    time: 'Il y a 1 heure',
                    unread: true,
                    icon: 'fa-clock'
                },
                {
                    id: 4,
                    type: 'info',
                    title: 'Nouvel établissement',
                    message: 'Un nouvel établissement partenaire a été ajouté.',
                    time: 'Il y a 2 heures',
                    unread: false,
                    icon: 'fa-university'
                },
                {
                    id: 5,
                    type: 'error',
                    title: 'Erreur système',
                    message: 'Problème de synchronisation avec la base de données.',
                    time: 'Il y a 3 heures',
                    unread: false,
                    icon: 'fa-exclamation-triangle'
                }
            ];

            console.log('Notifications data:', notificationsData);
            renderNotifications(notificationsData);
            updateNotificationCount(notificationsData);
        }

        // Fonction pour afficher les notifications
        function renderNotifications(notifications) {
            console.log('Rendering notifications:', notifications.length);
            const container = $('#notificationsList');
            
            if (container.length === 0) {
                console.error('Container #notificationsList not found!');
                return;
            }
            
            container.empty();

            if (notifications.length === 0) {
                container.html(`
                    <div class="notifications-empty">
                        <i class="fas fa-bell-slash"></i>
                        <p>Aucune notification</p>
                    </div>
                `);
                return;
            }

            notifications.forEach(function(notification) {
                const unreadClass = notification.unread ? 'unread' : '';
                const notificationHtml = `
                    <div class="notification-item ${unreadClass}" data-id="${notification.id}">
                        <div class="notification-content">
                            <div class="notification-icon ${notification.type}">
                                <i class="fas ${notification.icon}"></i>
                            </div>
                            <div class="notification-text">
                                <div class="notification-title">${notification.title}</div>
                                <div class="notification-message">${notification.message}</div>
                                <div class="notification-time">${notification.time}</div>
                            </div>
                        </div>
                    </div>
                `;
                container.append(notificationHtml);
            });

            // Ajouter les événements de clic sur les notifications
            $('.notification-item').off('click').on('click', function() {
                const notificationId = $(this).data('id');
                console.log('Notification clicked:', notificationId);
                markNotificationAsRead(notificationId);
            });
            
            console.log('Notifications rendered successfully');
        }

        // Fonction pour mettre à jour le compteur de notifications
        function updateNotificationCount(notifications) {
            const unreadCount = notifications.filter(n => n.unread).length;
            const badge = $('#notificationCount');
            
            console.log('Updating notification count:', unreadCount);
            
            if (unreadCount > 0) {
                badge.text(unreadCount).show();
            } else {
                badge.hide();
            }
        }

        // Fonction pour marquer une notification comme lue
        function markNotificationAsRead(notificationId) {
            console.log('Marking notification as read:', notificationId);
            
            const notificationItem = $(`.notification-item[data-id="${notificationId}"]`);
            notificationItem.removeClass('unread');
            
            // Mettre à jour les données
            const notification = notificationsData.find(n => n.id == notificationId);
            if (notification) {
                notification.unread = false;
            }
            
            // Mettre à jour le compteur
            updateNotificationCount(notificationsData);
            
            // Ici vous pouvez ajouter un appel AJAX pour marquer la notification comme lue côté serveur
            // $.post('/notifications/' + notificationId + '/read');
        }

        // Fonction pour marquer toutes les notifications comme lues
        function markAllNotificationsAsRead() {
            console.log('Marking all notifications as read');
            
            $('.notification-item.unread').removeClass('unread');
            
            // Mettre à jour toutes les données
            notificationsData.forEach(function(notification) {
                notification.unread = false;
            });
            
            updateNotificationCount(notificationsData);
            
            // Afficher un message de confirmation
            showNotificationToast('Toutes les notifications ont été marquées comme lues', 'success');
        }

        // Fonction pour afficher des notifications toast
        function showNotificationToast(message, type = 'info') {
            const toastClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';
            const toast = $(`
                <div class="toast align-items-center text-white ${toastClass} border-0" role="alert" style="position: fixed; top: 90px; right: 20px; z-index: 9999;">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `);
            
            $('body').append(toast);
            
            if (typeof bootstrap !== 'undefined') {
                const toastBootstrap = new bootstrap.Toast(toast[0]);
                toastBootstrap.show();
                
                // Supprimer le toast après qu'il soit caché
                toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            } else {
                // Fallback si Bootstrap n'est pas disponible
                setTimeout(function() {
                    toast.fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        }

            // Fonction pour charger les notifications
            function loadNotifications() {
                // Simulations de notifications (remplacez par un appel AJAX réel)
                const notifications = [
                    {
                        id: 1,
                        type: 'info',
                        title: 'Nouvelle formation ajoutée',
                        message: 'La formation "Développement Web" a été ajoutée au catalogue.',
                        time: 'Il y a 5 minutes',
                        unread: true,
                        icon: 'fa-graduation-cap'
                    },
                    {
                        id: 2,
                        type: 'success',
                        title: 'Candidature acceptée',
                        message: 'Une nouvelle candidature a été acceptée pour la formation Python.',
                        time: 'Il y a 15 minutes',
                        unread: true,
                        icon: 'fa-check-circle'
                    },
                    {
                        id: 3,
                        type: 'warning',
                        title: 'Formation à valider',
                        message: '5 candidatures sont en attente de validation.',
                        time: 'Il y a 1 heure',
                        unread: true,
                        icon: 'fa-clock'
                    },
                    {
                        id: 4,
                        type: 'info',
                        title: 'Nouvel établissement',
                        message: 'Un nouvel établissement partenaire a été ajouté.',
                        time: 'Il y a 2 heures',
                        unread: false,
                        icon: 'fa-university'
                    },
                    {
                        id: 5,
                        type: 'error',
                        title: 'Erreur système',
                        message: 'Problème de synchronisation avec la base de données.',
                        time: 'Il y a 3 heures',
                        unread: false,
                        icon: 'fa-exclamation-triangle'
                    }
                ];

                renderNotifications(notifications);
                updateNotificationCount(notifications);
            }

            // Fonction pour afficher les notifications
            function renderNotifications(notifications) {
                const container = $('#notificationsList');
                container.empty();

                if (notifications.length === 0) {
                    container.html(`
                        <div class="notifications-empty">
                            <i class="fas fa-bell-slash"></i>
                            <p>Aucune notification</p>
                        </div>
                    `);
                    return;
                }

                notifications.forEach(function(notification) {
                    const unreadClass = notification.unread ? 'unread' : '';
                    const notificationHtml = `
                        <div class="notification-item ${unreadClass}" data-id="${notification.id}">
                            <div class="notification-content">
                                <div class="notification-icon ${notification.type}">
                                    <i class="fas ${notification.icon}"></i>
                                </div>
                                <div class="notification-text">
                                    <div class="notification-title">${notification.title}</div>
                                    <div class="notification-message">${notification.message}</div>
                                    <div class="notification-time">${notification.time}</div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(notificationHtml);
                });

                // Ajouter les événements de clic sur les notifications
                $('.notification-item').click(function() {
                    const notificationId = $(this).data('id');
                    markNotificationAsRead(notificationId);
                    // Ici vous pouvez ajouter la logique pour rediriger vers la page concernée
                });
            }

            // Fonction pour mettre à jour le compteur de notifications
            function updateNotificationCount(notifications) {
                const unreadCount = notifications.filter(n => n.unread).length;
                const badge = $('#notificationCount');
                
                if (unreadCount > 0) {
                    badge.text(unreadCount).show();
                } else {
                    badge.hide();
                }
            }

            // Fonction pour marquer une notification comme lue
            function markNotificationAsRead(notificationId) {
                const notificationItem = $(`.notification-item[data-id="${notificationId}"]`);
                notificationItem.removeClass('unread');
                
                // Ici vous pouvez ajouter un appel AJAX pour marquer la notification comme lue côté serveur
                console.log('Notification ' + notificationId + ' marquée comme lue');
                
                // Recharger pour mettre à jour le compteur
                loadNotifications();
            }

            // Fonction pour marquer toutes les notifications comme lues
            function markAllNotificationsAsRead() {
                $('.notification-item.unread').removeClass('unread');
                $('#notificationCount').hide();
                
                // Ici vous pouvez ajouter un appel AJAX pour marquer toutes les notifications comme lues
                console.log('Toutes les notifications marquées comme lues');
                
                // Afficher un message de confirmation
                showNotificationToast('Toutes les notifications ont été marquées comme lues', 'success');
            }

            // Fonction pour afficher des notifications toast
            function showNotificationToast(message, type = 'info') {
                const toastClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';
                const toast = $(`
                    <div class="toast align-items-center text-white ${toastClass} border-0" role="alert" style="position: fixed; top: 90px; right: 20px; z-index: 9999;">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `);
                
                $('body').append(toast);
                const toastBootstrap = new bootstrap.Toast(toast[0]);
                toastBootstrap.show();
                
                // Supprimer le toast après qu'il soit caché
                toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }

            // Charger les notifications au démarrage
            loadNotifications();

            // Simuler l'arrivée de nouvelles notifications (pour la démo)
            setInterval(function() {
                // Ici vous pouvez ajouter la logique pour vérifier les nouvelles notifications
                // loadNotifications();
            }, 30000); // Vérifier toutes les 30 secondes

            // Fermer sidebar avec overlay
            $('#sidebarOverlay').click(function() {
                $('.sidebar').removeClass('show');
                $('#sidebarOverlay').removeClass('show');
            });

            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#toggleSidebar').length) {
                        $('.sidebar').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                    }
                }
            });

            // Animation pour les liens de navigation
            $('.sidebar-link').on('mouseenter', function() {
                $(this).find('i').addClass('fa-pulse');
            }).on('mouseleave', function() {
                $(this).find('i').removeClass('fa-pulse');
            });

            // Smooth scroll pour les ancres
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });
        });
    </script>
    
    @stack('scripts')

    <!-- Generic Image View Modal HTML -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewImageModalLabel">Aperçu de l'image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img src="" id="modalImageDisplay" class="img-fluid" alt="Image en grand">
          </div>
        </div>
      </div>
    </div>
</body>
</html>
