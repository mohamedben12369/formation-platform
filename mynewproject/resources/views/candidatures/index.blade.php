<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Candidature - ODR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="candidatures-page">
        <!-- Header -->
        <header class="main-header">
            <div class="container">
                <div class="logo">
                    <a href="{{ url('/') }}" class="logo-link">
                        <img src="{{ asset('images/Logos.jpg') }}" alt="Logo" class="logo-image">
                        <span class="logo-text">ODR</span>
                    </a>
                </div>
                <nav class="nav-links">
                    <ul>
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li><a href="{{ route('decouvrez-nous') }}">{{ __('Découvrez-nous') }}</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{url('/candidatures')}}" class="active">Candidatures</a></li>
                        <li><a href="{{ route('entreprise.dashboard') }}" class="entreprise-nav-link"><i class="fas fa-building me-1"></i>Espace Entreprise</a></li>
                       
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn">Logout</button>
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="profile-avatar-link">
                                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2563eb&color=fff&size=64' }}" alt="Profile" class="profile-avatar" />
                                    <div class="profile-info">
                                        <span class="profile-name">{{ Auth::user()->name }}</span>
                                        <span class="profile-role">Mon Profil</span>
                                    </div>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            <i class="fas fa-users-cog hero-icon"></i>
                            Offres de Candidature
                        </h1>
                        <p class="hero-subtitle">Découvrez les opportunités professionnelles qui correspondent à vos compétences et ambitions</p>
                    </div>
                </div>
            </section>

            <!-- Search and Filter Section -->
            <section class="search-section">
                <div class="search-container">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Rechercher une candidature..." class="search-input">
                    </div>
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">
                            <i class="fas fa-list"></i> Toutes
                        </button>
                        <button class="filter-btn" data-filter="recent">
                            <i class="fas fa-clock"></i> Récentes
                        </button>
                        <button class="filter-btn" data-filter="popular">
                            <i class="fas fa-fire"></i> Populaires
                        </button>
                        <button class="filter-btn" data-filter="urgent">
                            <i class="fas fa-exclamation-triangle"></i> Urgentes
                        </button>
                    </div>
                </div>
            </section>            <!-- Candidatures Grid -->
            <section class="candidatures-section">
                <div class="candidatures-grid">                    @forelse($formations as $formation)
                        <div class="candidature-card" data-category="recent">
                            <!-- Image de formation -->
                            <div class="candidature-image">
                                @if($formation->image)
                                    <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->nom }}" class="formation-img">
                                @else
                                    <div class="formation-img-placeholder">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ strtoupper(substr($formation->nom, 0, 2)) }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="candidature-header">
                                <div class="candidature-badge normal">
                                    DISPONIBLE
                                </div>
                                <div class="candidature-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($formation->dateDebut)->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="candidature-content">
                                <h3 class="candidature-title">{{ $formation->nom }}</h3>
                                <div class="candidature-company">
                                    <i class="fas fa-building"></i>
                                    <span>{{ $formation->entreprise->nom ?? 'ODR Formation' }}</span>
                                </div>
                                <div class="candidature-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $formation->lieu }}</span>
                                </div>
                                <div class="candidature-type">
                                    <i class="fas fa-briefcase"></i>
                                    <span>{{ $formation->typeFormation->nom ?? 'Formation' }}</span>
                                </div>
                                <div class="candidature-duration">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $formation->duree }}</span>
                                </div>
                                <div class="candidature-modality">
                                    <i class="fas fa-desktop"></i>
                                    <span>{{ $formation->modalite }}</span>
                                </div>
                            </div>

                            <div class="candidature-description">
                                <p>{{ $formation->objectifs ? Str::limit($formation->objectifs, 150) : 'Découvrez cette formation professionnelle qui vous permettra de développer vos compétences.' }}</p>
                            </div>                            <div class="candidature-skills">
                                <div class="skills-title">Thèmes de formation :</div>
                                @if($formation->themes && $formation->themes->count())
                                    <div class="themes-detailed-list">
                                        @foreach($formation->themes as $theme)
                                            <div class="theme-detailed-item">
                                                <div class="theme-name">
                                                    <span class="skill-tag">{{ $theme->titre }}</span>
                                                </div>
                                                @if($theme->prerequis_array && count($theme->prerequis_array) > 0)
                                                    <div class="theme-prerequisites-mini">
                                                        <small class="prerequis-label-mini">
                                                            <i class="fas fa-check-circle"></i>
                                                            Prérequis :
                                                        </small>
                                                        <div class="prerequis-mini-list">
                                                            @foreach($theme->prerequis_array as $prerequis)
                                                                <small class="prerequis-mini-item">{{ trim($prerequis) }}</small>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="skills-tags">
                                        <span class="skill-tag">Formation Générale</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Détails supplémentaires -->
                            <div class="candidature-details" style="display: none;">
                                <div class="details-content">
                                    @if($formation->prerequis)
                                        <div class="detail-item">
                                            <strong>Prérequis :</strong>
                                            <p>{{ $formation->prerequis }}</p>
                                        </div>
                                    @endif
                                    @if($formation->programme)
                                        <div class="detail-item">
                                            <strong>Programme :</strong>
                                            <p>{{ $formation->programme }}</p>
                                        </div>
                                    @endif
                                    @if($formation->prix)
                                        <div class="detail-item">
                                            <strong>Prix :</strong>
                                            <p>{{ $formation->prix }} €</p>
                                        </div>
                                    @endif
                                    @if($formation->nombrePlaces)
                                        <div class="detail-item">
                                            <strong>Places disponibles :</strong>
                                            <p>{{ $formation->nombrePlaces }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="candidature-footer">
                                <div class="candidature-actions-full">
                                    <button class="btn-details" onclick="toggleDetails(this)">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="details-text">Voir détails</span>
                                    </button>
                                    @auth
                                        <a href="{{ route('candidatures.create', $formation) }}" class="btn-candidater">
                                            <i class="fas fa-paper-plane"></i>
                                            Candidater
                                        </a>
                                        <button class="btn-favoris" onclick="toggleFavoris({{ $formation->id }})">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-candidater">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Se connecter pour candidater
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-candidatures">
                            <div class="no-candidatures-content">
                                <i class="fas fa-search fa-4x"></i>
                                <h3>Aucune formation disponible</h3>
                                <p>Il n'y a pas de formations ouvertes aux candidatures pour le moment.</p>
                                <a href="{{ url('/') }}" class="btn-retour">
                                    <i class="fas fa-home"></i>
                                    Retour à l'accueil
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .candidatures-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
        }

        .candidatures-page::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: 1;
        }

        /* Header Styles */
        .main-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 1.5rem 0;
            box-shadow: 0 4px 20px rgba(37,99,235,0.15);
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .main-header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
            padding: 0 2rem;
        }

        .logo-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #fff !important;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .logo-image {
            height: 45px;
            width: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .nav-links ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-links a:hover, .nav-links a.active {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar-link {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            color: #fff;
            text-decoration: none;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
            object-fit: cover;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: #fff;
        }

        .profile-role {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.8);
        }

        .logout-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Main Content */
        main {
            flex: 1;
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -5px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-top: 2rem;
            padding: 0;
        }

        /* Hero Section */
        .hero-section {
            padding: 4rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            margin-bottom: 3rem;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .hero-icon {
            font-size: 2.5rem;
            opacity: 0.9;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Search Section */
        .search-section {
            padding: 0 2rem 3rem 2rem;
        }

        .search-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .search-bar {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 50px;
            font-size: 1.1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 1.2rem;
        }

        .filter-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: white;
            border: 2px solid rgba(102, 126, 234, 0.2);
            color: #667eea;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Candidatures Grid */
        .candidatures-section {
            padding: 0 2rem 4rem 2rem;
        }

        .candidatures-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }        .candidature-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(37,99,235,0.1);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .candidature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(37,99,235,0.2);
        }

        /* Styles pour l'image de formation */
        .candidature-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .formation-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .candidature-card:hover .formation-img {
            transform: scale(1.05);
        }

        .formation-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .formation-img-placeholder i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }

        .formation-img-placeholder span {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .candidature-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .candidature-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .candidature-badge.urgent {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .candidature-badge.normal {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .candidature-date {
            color: #6b7280;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .candidature-content {
            padding: 1.5rem;
        }

        .candidature-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .candidature-content > div {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #6b7280;
        }

        .candidature-description {
            padding: 0 1.5rem;
            color: #4b5563;
            line-height: 1.6;
        }

        .candidature-skills {
            padding: 1.5rem;
        }

        .skills-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }

        .skills-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
        }        .candidature-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .candidature-actions-full {
            display: flex;
            gap: 0.5rem;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .btn-details {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 2px solid rgba(102, 126, 234, 0.2);
            padding: 0.8rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-details:hover {
            background: #667eea;
            color: white;
            transform: translateY(-1px);
        }

        .candidature-details {
            padding: 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
            animation: slideDown 0.3s ease-out;
        }

        .detail-item {
            margin-bottom: 1rem;
        }

        .detail-item strong {
            color: #374151;
            display: block;
            margin-bottom: 0.5rem;
        }

        .detail-item p {
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        .no-candidatures {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
        }

        .no-candidatures-content {
            max-width: 400px;
            margin: 0 auto;
        }

        .no-candidatures-content i {
            color: #9ca3af;
            margin-bottom: 2rem;
        }

        .no-candidatures-content h3 {
            color: #374151;
            margin-bottom: 1rem;
        }

        .no-candidatures-content p {
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-retour {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-retour:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 500px;
            }
        }

        .candidature-salary {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #059669;
        }

        .candidature-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-candidater {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-candidater:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-favoris {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.8rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-favoris:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .candidatures-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-title {
                font-size: 2rem;
                flex-direction: column;
            }
            
            .filter-buttons {
                gap: 0.5rem;
            }
            
            .filter-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
              .nav-links ul {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .main-header .container {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        /* Styles pour les thèmes avec prérequis dans la page candidatures */
        .themes-detailed-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .theme-detailed-item {
            background: rgba(59, 130, 246, 0.05);
            border-radius: 8px;
            padding: 0.8rem;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .theme-name {
            margin-bottom: 0.5rem;
        }

        .theme-prerequisites-mini {
            margin-top: 0.5rem;
        }

        .prerequis-label-mini {
            display: flex;
            align-items: center;
            color: #059669;
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .prerequis-label-mini i {
            margin-right: 0.3rem;
            font-size: 0.7rem;
        }

        .prerequis-mini-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
        }

        .prerequis-mini-item {
            background: rgba(5, 150, 105, 0.1);
            color: #047857;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid rgba(5, 150, 105, 0.2);
        }

        @media (max-width: 768px) {
            .themes-detailed-list {
                gap: 0.7rem;
            }
            
            .theme-detailed-item {
                padding: 0.6rem;
            }
            
            .prerequis-mini-list {
                flex-direction: column;
                gap: 0.2rem;
            }
        }
    </style>

    <!-- Scripts -->
    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const candidatureCards = document.querySelectorAll('.candidature-card');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    candidatureCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                        } else {
                            const category = card.getAttribute('data-category');
                            card.style.display = category === filter ? 'block' : 'none';
                        }
                    });
                });
            });
        });

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const candidatureCards = document.querySelectorAll('.candidature-card');
            
            candidatureCards.forEach(card => {
                const title = card.querySelector('.candidature-title').textContent.toLowerCase();
                const company = card.querySelector('.candidature-company span').textContent.toLowerCase();
                const description = card.querySelector('.candidature-description p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || company.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });        // Candidater function - redirect to existing candidature system
        function candidater(id) {
            // This will use the existing candidature route
            window.location.href = `/formations/${id}/candidater`;
        }

        // Toggle details function
        function toggleDetails(button) {
            const card = button.closest('.candidature-card');
            const details = card.querySelector('.candidature-details');
            const detailsText = button.querySelector('.details-text');
            
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
                detailsText.textContent = 'Masquer détails';
                button.style.background = '#667eea';
                button.style.color = 'white';
            } else {
                details.style.display = 'none';
                detailsText.textContent = 'Voir détails';
                button.style.background = 'rgba(102, 126, 234, 0.1)';
                button.style.color = '#667eea';
            }
        }

        // Toggle favoris function
        function toggleFavoris(id) {
            const btn = event.currentTarget;
            const icon = btn.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                btn.style.background = '#ef4444';
                btn.style.borderColor = '#ef4444';
                btn.style.color = 'white';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                btn.style.background = 'white';
                btn.style.borderColor = '#667eea';
                btn.style.color = '#667eea';
            }
        }
    </script>
</body>
</html>
