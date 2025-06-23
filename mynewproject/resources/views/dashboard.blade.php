@extends('layouts.app')

@section('content')
<div class="modern-dashboard">
    <!-- Header avec titre et stats rapides -->
    <div class="dashboard-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="dashboard-title">
                        <i class="fas fa-tachometer-alt me-3"></i>
                        Tableau de Bord
                    </h1>
                    <p class="dashboard-subtitle">Gérez votre plateforme de formation en un coup d'œil</p>
                </div>
                <div class="col-md-4">
                    <div class="stats-quick">
                        <div class="quick-stat">
                            <span class="stat-number">{{ $formationsCount ?? 0 }}</span>
                            <span class="stat-label">Formations</span>
                        </div>
                        <div class="quick-stat">
                            <span class="stat-number">{{ $candidaturesCount ?? 0 }}</span>
                            <span class="stat-label">Candidatures</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid dashboard-content">
        <!-- Section Gestion des Formations -->
        <div class="section-card formations-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#formationsCollapse" aria-expanded="true">
                <div class="section-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Gestion des Formations</h3>
                    <p class="section-description">Gérez les formations, axes, domaines et thèmes</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse show" id="formationsCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.formations.index') }}" class="modern-card formations-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Formations</h4>
                            <p class="card-subtitle">Gérer les formations</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $formationsCount ?? 0 }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.axes.index') }}" class="modern-card axes-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Axes</h4>
                            <p class="card-subtitle">Axes stratégiques</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $axesCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.domaines.index') }}" class="modern-card domaines-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Domaines</h4>
                            <p class="card-subtitle">Domaines de formation</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $domainesCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.sous-domaines.index') }}" class="modern-card sous-domaines-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-code-branch"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Sous-Domaines</h4>
                            <p class="card-subtitle">Spécialisations</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $sousDomainesCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.theme-formations.index') }}" class="modern-card themes-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Thèmes</h4>
                            <p class="card-subtitle">Thèmes de formation</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $themeFormationsCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.entreprises.index') }}" class="modern-card entreprises-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Entreprises</h4>
                            <p class="card-subtitle">Partenaires</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $entreprisesCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.formateurs.index') }}" class="modern-card formateurs-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Formateurs</h4>
                            <p class="card-subtitle">Équipe pédagogique</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $formateursCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Gestion des Candidatures -->
        <div class="section-card candidatures-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#candidaturesCollapse" aria-expanded="true">
                <div class="section-icon">
                    <i class="fas fa-file-user"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Gestion des Candidatures</h3>
                    <p class="section-description">Suivez et gérez toutes les candidatures</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse show" id="candidaturesCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.candidatures.index') }}" class="modern-card candidatures-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Candidatures</h4>
                            <p class="card-subtitle">Toutes les candidatures</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $candidaturesCount ?? 0 }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.candidatures.index', ['statut' => 'en_attente']) }}" class="modern-card attente-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">En Attente</h4>
                            <p class="card-subtitle">À traiter</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $candidaturesEnAttenteCount ?? 0 }}</span>
                                <span class="metric-label">Candidatures</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.candidatures.index', ['statut' => 'accepte']) }}" class="modern-card acceptees-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Acceptées</h4>
                            <p class="card-subtitle">Validées</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $candidaturesAccepteesCount ?? 0 }}</span>
                                <span class="metric-label">Candidatures</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.type-documents.index') }}" class="modern-card documents-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Types Documents</h4>
                            <p class="card-subtitle">Configuration</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $typeDocumentsCount ?? 0 }}</span>
                                <span class="metric-label">Types</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Gestion des Compétences -->
        <div class="section-card competences-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#competencesCollapse" aria-expanded="true">
                <div class="section-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Gestion des Compétences</h3>
                    <p class="section-description">Gérez les niveaux et compétences</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse show" id="competencesCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.niveaux.index') }}" class="modern-card niveaux-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Niveaux</h4>
                            <p class="card-subtitle">Niveaux de compétence</p>
                            <div class="card-metric">
                                <span class="metric-number">•</span>
                                <span class="metric-label">Gérer</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Gestion des Diplômes -->
        <div class="section-card diplomes-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#diplomesCollapse" aria-expanded="true">
                <div class="section-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Gestion des Diplômes</h3>
                    <p class="section-description">Types de diplômes et établissements</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse show" id="diplomesCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.type-diplomes.index') }}" class="modern-card type-diplomes-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Types Diplômes</h4>
                            <p class="card-subtitle">Catégories de diplômes</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $typeDiplomesCount }}</span>
                                <span class="metric-label">Types</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.etablissements.index') }}" class="modern-card etablissements-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Établissements</h4>
                            <p class="card-subtitle">Institutions partenaires</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $etablissementsCount }}</span>
                                <span class="metric-label">Total</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Gestion des Expériences -->
        <div class="section-card experiences-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#experiencesCollapse" aria-expanded="true">
                <div class="section-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Gestion des Expériences</h3>
                    <p class="section-description">Types d'expériences professionnelles</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse show" id="experiencesCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.type-experiences.index') }}" class="modern-card type-experiences-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Types Expérience</h4>
                            <p class="card-subtitle">Catégories d'expérience</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $typeExperiencesCount }}</span>
                                <span class="metric-label">Types</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Gestion des Utilisateurs -->
        <div class="section-card users-section">
            <div class="section-header" data-bs-toggle="collapse" data-bs-target="#usersCollapse" aria-expanded="false">
                <div class="section-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="section-info">
                    <h3 class="section-title">Utilisateurs & Permissions</h3>
                    <p class="section-description">Gestion des utilisateurs, rôles et permissions</p>
                </div>
                <div class="section-toggle">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
            </div>
            <div class="collapse" id="usersCollapse">
                <div class="cards-grid">
                    <a href="{{ route('dashboard.users.index') }}" class="modern-card users-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Utilisateurs</h4>
                            <p class="card-subtitle">Comptes utilisateurs</p>
                            <div class="card-metric">
                                <span class="metric-number">•</span>
                                <span class="metric-label">Gérer</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.roles.index') }}" class="modern-card roles-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Rôles</h4>
                            <p class="card-subtitle">Rôles système</p>
                            <div class="card-metric">
                                <span class="metric-number">•</span>
                                <span class="metric-label">Gérer</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.permissions.index') }}" class="modern-card permissions-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Permissions</h4>
                            <p class="card-subtitle">Autorisations</p>
                            <div class="card-metric">
                                <span class="metric-number">•</span>
                                <span class="metric-label">Gérer</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.securite-questions.index') }}" class="modern-card securite-card">
                        <div class="card-gradient"></div>
                        <div class="card-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Questions Sécurité</h4>
                            <p class="card-subtitle">Questions de récupération</p>
                            <div class="card-metric">
                                <span class="metric-number">{{ $securiteQuestionsCount }}</span>
                                <span class="metric-label">Questions</span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Variables CSS pour une cohérence des couleurs */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --info-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --dark-gradient: linear-gradient(135deg, #434343 0%, #000000 100%);
        --card-bg: rgba(255, 255, 255, 0.02);
        --text-primary: #ffffff;
        --text-secondary: #b8bcc8;
        --border-color: rgba(255, 255, 255, 0.1);
    }

    /* Arrière-plan du dashboard */
    .modern-dashboard {
        min-height: 100vh;
        background: linear-gradient(135deg, #1e1e2e 0%, #2a2a40 50%, #1e1e2e 100%);
        padding: 0;
    }

    /* Header du dashboard */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(255,255,255,0.1) 100%);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        margin: 0;
    }

    .dashboard-subtitle {
        font-size: 1.1rem;
        color: var(--text-secondary);
        margin: 0.5rem 0 0 0;
    }

    .stats-quick {
        display: flex;
        gap: 2rem;
        justify-content: flex-end;
    }

    .quick-stat {
        text-align: center;
        padding: 1rem;
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        backdrop-filter: blur(10px);
    }

    .stat-number {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    /* Container principal */
    .dashboard-content {
        padding: 0 2rem 2rem 2rem;
    }

    /* Sections */
    .section-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        margin-bottom: 2rem;
        overflow: hidden;
        backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .section-header {
        display: flex;
        align-items: center;
        padding: 1.5rem 2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(90deg, rgba(255,255,255,0.05) 0%, transparent 100%);
    }

    .section-header:hover {
        background: linear-gradient(90deg, rgba(255,255,255,0.1) 0%, transparent 100%);
    }

    .section-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-right: 1.5rem;
        background: var(--primary-gradient);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .formations-section .section-icon { background: var(--primary-gradient); }
    .candidatures-section .section-icon { background: var(--secondary-gradient); }
    .competences-section .section-icon { background: var(--success-gradient); }
    .diplomes-section .section-icon { background: var(--warning-gradient); }
    .experiences-section .section-icon { background: var(--info-gradient); }
    .users-section .section-icon { background: var(--dark-gradient); }

    .section-info {
        flex: 1;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 0.5rem 0;
    }

    .section-description {
        font-size: 0.95rem;
        color: var(--text-secondary);
        margin: 0;
    }

    .section-toggle {
        font-size: 1.2rem;
        color: var(--text-secondary);
    }

    .toggle-icon {
        transition: transform 0.3s ease;
    }

    [aria-expanded="true"] .toggle-icon {
        transform: rotate(180deg);
    }

    /* Grille de cartes */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }

    /* Cartes modernes */
    .modern-card {
        position: relative;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.3s ease;
        overflow: hidden;
        backdrop-filter: blur(10px);
        min-height: 140px;
        display: flex;
        align-items: center;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255,255,255,0.3);
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        color: var(--text-primary);
    }

    .modern-card:hover .card-gradient {
        opacity: 1;
    }

    .modern-card:hover .card-arrow {
        transform: translateX(5px);
    }

    .card-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .formations-card .card-gradient { background: var(--primary-gradient); }
    .axes-card .card-gradient { background: var(--primary-gradient); }
    .domaines-card .card-gradient { background: var(--success-gradient); }
    .sous-domaines-card .card-gradient { background: var(--info-gradient); }
    .themes-card .card-gradient { background: var(--warning-gradient); }
    .entreprises-card .card-gradient { background: var(--secondary-gradient); }
    .formateurs-card .card-gradient { background: var(--dark-gradient); }
    .candidatures-card .card-gradient { background: var(--secondary-gradient); }
    .attente-card .card-gradient { background: var(--warning-gradient); }
    .acceptees-card .card-gradient { background: var(--success-gradient); }
    .documents-card .card-gradient { background: var(--info-gradient); }
    .niveaux-card .card-gradient { background: var(--success-gradient); }
    .type-diplomes-card .card-gradient { background: var(--warning-gradient); }
    .etablissements-card .card-gradient { background: var(--primary-gradient); }
    .type-experiences-card .card-gradient { background: var(--info-gradient); }
    .users-card .card-gradient { background: var(--dark-gradient); }
    .roles-card .card-gradient { background: var(--primary-gradient); }
    .permissions-card .card-gradient { background: var(--info-gradient); }
    .securite-card .card-gradient { background: var(--warning-gradient); }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-right: 1rem;
        position: relative;
        z-index: 2;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }

    .card-content {
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0.25rem 0;
        color: var(--text-primary);
    }

    .card-subtitle {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin: 0 0 0.75rem 0;
    }

    .card-metric {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
    }

    .metric-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .metric-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-arrow {
        font-size: 1.2rem;
        color: var(--text-secondary);
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1rem 0;
        }
        
        .dashboard-title {
            font-size: 1.8rem;
        }
        
        .stats-quick {
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .dashboard-content {
            padding: 0 1rem 1rem 1rem;
        }
        
        .section-header {
            padding: 1rem;
        }
        
        .cards-grid {
            grid-template-columns: 1fr;
            padding: 1rem;
        }
        
        .modern-card {
            min-height: 120px;
        }
    }

    /* Animation pour le chargement */
    .modern-card {
        animation: slideInUp 0.5s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animation pour les sections */
    .section-card {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@endsection
