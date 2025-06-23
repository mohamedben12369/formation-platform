<!-- Footer Component -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>{{ __('Menu') }}</h3>
            <ul>
                <li><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
                <li><a href="{{ route('decouvrez-nous') }}">{{ __('Découvrez-nous') }}</a></li>
                <li><a href="#">{{ __('Formation') }}</a></li>
                <li><a href="#">{{ __('Contact') }}</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>{{ __('Financement') }}</h3>
            <ul>
                <li>{{ __('Maroc PME') }}</li>
                <li>{{ __('GIAC') }}</li>
                <li>{{ __('BERD') }}</li>
                <li>{{ __('Gestion des CSF') }}</li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>{{ __('Coordonnées') }}</h3>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i> 7 Rue des Papillons, Casablanca</li>
                <li><i class="fas fa-phone"></i> +212 522 991 911</li>
                <li><i class="fas fa-envelope"></i> licorne@licorne.ma</li>
                <li><i class="fas fa-fax"></i> Fax: +212 522 992 552</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Copyright 2025 © All rights reserved</p>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    color: #fff;
    padding: 4rem 0 1rem 0;
    margin-top: 4rem;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 3rem;
    padding: 0 2rem;
}

.footer-section h3 {
    color: #fff;
    font-size: 1.35rem;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.75rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: 1rem;
}

.footer-section ul li a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #4f46e5;
}

.footer-section i {
    margin-right: 0.75rem;
    color: #4f46e5;
}

.footer-bottom {
    text-align: center;
    margin-top: 4rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.1);
    color: #94a3b8;
}

@media (max-width: 768px) {
    .footer-section {
        text-align: center;
    }
}
</style>
