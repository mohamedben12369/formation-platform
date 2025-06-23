@extends('layouts.app')

@section('content')
<div class="about-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="hero-title-main">À propos d'</span>
                        <span class="hero-title-accent">ODR Formation</span>
                    </h1>
                    <p class="hero-description">
                        Découvrez notre mission, notre vision et notre engagement à transformer l'éducation professionnelle pour un avenir meilleur.
                    </p>
                    <div class="hero-actions">
                        <a href="#mission" class="btn-hero-primary">
                            <i class="fas fa-compass"></i>
                            Notre Mission
                        </a>
                        <a href="#equipe" class="btn-hero-secondary">
                            <i class="fas fa-users"></i>
                            Notre Équipe
                        </a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-image-wrapper">
                        <div class="hero-floating-card hero-card-1">
                            <i class="fas fa-lightbulb"></i>
                            <span>Innovation</span>
                        </div>
                        <div class="hero-floating-card hero-card-2">
                            <i class="fas fa-heart"></i>
                            <span>Passion</span>
                        </div>
                        <div class="hero-floating-card hero-card-3">
                            <i class="fas fa-trophy"></i>
                            <span>Excellence</span>
                        </div>
                        <div class="hero-main-visual">
                            <div class="hero-gradient-orb"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section id="mission" class="mission-section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-compass"></i>
                    Notre Mission
                </h2>
                <p class="section-subtitle">
                    Démocratiser l'accès à l'éducation professionnelle de qualité pour tous
                </p>
            </div>

            <div class="mission-content">
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Éducation de Qualité</h3>
                        <p>
                            Nous nous engageons à fournir des formations de la plus haute qualité, 
                            adaptées aux besoins du marché du travail moderne.
                        </p>
                    </div>

                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Accessibilité</h3>
                        <p>
                            Notre plateforme est conçue pour être accessible à tous, 
                            indépendamment de la localisation ou du niveau socio-économique.
                        </p>
                    </div>

                    <div class="mission-card">
                        <div class="mission-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>
                            Nous utilisons les dernières technologies pour créer 
                            des expériences d'apprentissage immersives et efficaces.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="section-container">
            <div class="values-content">
                <div class="values-text">
                    <h2 class="section-title">Nos Valeurs</h2>
                    <div class="values-list">
                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="value-content">
                                <h4>Passion</h4>
                                <p>Notre passion pour l'éducation guide chacune de nos décisions et innovations.</p>
                            </div>
                        </div>

                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="value-content">
                                <h4>Intégrité</h4>
                                <p>Nous agissons avec transparence et honnêteté dans toutes nos interactions.</p>
                            </div>
                        </div>

                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="value-content">
                                <h4>Collaboration</h4>
                                <p>Nous croyons en la force du travail d'équipe et de la communauté d'apprentissage.</p>
                            </div>
                        </div>

                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="value-content">
                                <h4>Excellence</h4>
                                <p>Nous visons l'excellence dans tout ce que nous faisons, de nos formations à notre support.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="values-visual">
                    <div class="values-image-wrapper">
                        <img src="{{ asset('images/team-values.jpg') }}" alt="Nos valeurs" class="values-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="equipe" class="team-section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-users"></i>
                    Notre Équipe
                </h2>
                <p class="section-subtitle">
                    Rencontrez les personnes passionnées qui rendent tout cela possible
                </p>
            </div>

            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="{{ asset('images/team/ceo.jpg') }}" alt="CEO" class="member-image">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>Jean Dupont</h4>
                        <span class="member-role">Directeur Général</span>
                        <p>Passionné d'éducation avec plus de 15 ans d'expérience dans le développement de solutions d'apprentissage innovantes.</p>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-photo">
                        <img src="{{ asset('images/team/cto.jpg') }}" alt="CTO" class="member-image">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>Marie Martin</h4>
                        <span class="member-role">Directrice Technique</span>
                        <p>Experte en technologies éducatives, elle dirige notre équipe de développement vers l'innovation constante.</p>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-photo">
                        <img src="{{ asset('images/team/education.jpg') }}" alt="Directeur Éducation" class="member-image">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>Pierre Dubois</h4>
                        <span class="member-role">Directeur Pédagogique</span>
                        <p>Responsable de la qualité de nos contenus éducatifs et de l'expérience d'apprentissage de nos étudiants.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="contact-cta-section">
        <div class="section-container">
            <div class="cta-content">
                <h2>Rejoignez notre aventure</h2>
                <p>Prêt à transformer votre carrière avec nos formations ? Contactez-nous dès aujourd'hui !</p>
                <div class="cta-actions">
                    <a href="{{ route('register') }}" class="btn-cta-primary">
                        <i class="fas fa-user-plus"></i>
                        Commencer maintenant
                    </a>
                    <a href="{{ url('/contact') }}" class="btn-cta-secondary">
                        <i class="fas fa-envelope"></i>
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
/* Use the same styling variables and base styles from welcome.blade.php */
:root {
    /* Same color palette as welcome page */
    --primary: #667eea;
    --primary-dark: #5a6acf;
    --primary-light: #7c3aed;
    --secondary: #06b6d4;
    --accent: #fbbf24;
    
    /* Same gradients */
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #06b6d4 0%, #14b8a6 100%);
    --gradient-accent: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    --gradient-violet: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #d946ef 100%);
    --gradient-rainbow: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 20%, #d946ef 40%, #fbbf24 60%, #f59e0b 80%, #fcd34d 100%);
    
    /* Same shadows and effects */
    --shadow: 0 4px 12px rgba(139, 92, 246, 0.12), 0 2px 4px rgba(251, 191, 36, 0.08);
    --shadow-lg: 0 12px 24px rgba(139, 92, 246, 0.15), 0 6px 12px rgba(124, 58, 237, 0.1);
    --shadow-xl: 0 20px 40px rgba(139, 92, 246, 0.18), 0 10px 20px rgba(251, 191, 36, 0.12);
    
    --radius: 20px;
    --radius-lg: 28px;
}

.about-page {
    min-height: 100vh;
    background: var(--gradient-violet);
}

/* Hero Section - Same styling as welcome page */
.hero-section {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    padding: 8rem 0 6rem;
    position: relative;
    overflow: hidden;
}

/* Mission Section */
.mission-section {
    padding: 6rem 0;
    background: rgba(255, 255, 255, 0.95);
}

.mission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
    margin-top: 4rem;
}

.mission-card {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.mission-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.mission-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 2rem;
    background: var(--gradient-rainbow);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

/* Values Section */
.values-section {
    padding: 6rem 0;
    background: var(--gradient-violet);
}

.values-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6rem;
    align-items: center;
}

.value-item {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 3rem;
    align-items: flex-start;
}

.value-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.value-content h4 {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.value-content p {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
}

.values-image-wrapper {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.values-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

/* Team Section */
.team-section {
    padding: 6rem 0;
    background: rgba(255, 255, 255, 0.95);
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
    margin-top: 4rem;
}

.team-member {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.team-member:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.member-photo {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.member-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--gradient-rainbow);
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.team-member:hover .member-overlay {
    opacity: 1;
}

.team-member:hover .member-image {
    transform: scale(1.1);
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    text-decoration: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: scale(1.1);
    color: var(--primary);
}

.member-info {
    padding: 2rem;
    text-align: center;
}

.member-info h4 {
    color: var(--primary);
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.member-role {
    color: var(--accent);
    font-weight: 600;
    font-size: 0.95rem;
    display: block;
    margin-bottom: 1rem;
}

.member-info p {
    color: #666;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* Contact CTA Section */
.contact-cta-section {
    padding: 6rem 0;
    background: var(--gradient-rainbow);
    text-align: center;
}

.cta-content h2 {
    color: white;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
}

.cta-content p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.25rem;
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-actions {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-cta-primary,
.btn-cta-secondary {
    padding: 1.25rem 2.5rem;
    border-radius: var(--radius);
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-cta-primary {
    background: white;
    color: var(--primary);
    box-shadow: var(--shadow);
}

.btn-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-xl);
    color: var(--primary);
}

.btn-cta-secondary {
    background: transparent;
    color: white;
    border-color: white;
}

.btn-cta-secondary:hover {
    background: white;
    color: var(--primary);
    transform: translateY(-3px);
}

/* Responsive */
@media (max-width: 768px) {
    .values-content {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
    
    .cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-cta-primary,
    .btn-cta-secondary {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Same animation and interaction scripts as welcome page
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Animate sections on scroll
    document.querySelectorAll('.mission-card, .team-member, .value-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});
</script>
@endpush
