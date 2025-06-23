<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Découvrez-nous') }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8fafc;
            color: #1e293b;
        }

        .discover-header {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
        }

        .discover-header h1 {
            font-size: 3rem;
            margin: 0 0 1rem 0;
            font-weight: 700;
        }

        .discover-header p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }

        .content-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            background: #f0f4ff;
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: #4f46e5;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin: 0 0 1rem 0;
            color: #1e293b;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        .values-section {
            background: #f1f5f9;
            padding: 4rem 0;
            margin-top: 4rem;
        }

        .team-section {
            text-align: center;
            padding: 4rem 0;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .team-member {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto 3rem auto;
            font-size: 1.125rem;
            line-height: 1.6;
        }

        .timeline-section {
            background: #fff;
            padding: 4rem 0;
        }

        .timeline {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .timeline-item {
            padding: 2rem;
            border-left: 2px solid #4f46e5;
            position: relative;
            margin-left: 2rem;
            margin-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            width: 15px;
            height: 15px;
            background: #4f46e5;
            border-radius: 50%;
            position: absolute;
            left: -8.5px;
            top: 2rem;
        }

        .timeline-year {
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 0.5rem;
        }

        .testimonials-section {
            background: #f1f5f9;
            padding: 4rem 0;
        }

        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .testimonial-text {
            font-style: italic;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: #1e293b;
        }

        .testimonial-position {
            color: #64748b;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .discover-header {
                padding: 4rem 1rem;
            }

            .discover-header h1 {
                font-size: 2.25rem;
            }

            .content-section {
                padding: 3rem 1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="discover-header">
        <h1>{{ __('Qui Sommes Nous?') }}</h1>
        <p>{{ __('Plus de 20 ans au service de nos clients') }}</p>
    </div>

    <section class="content-section">
        <div class="feature-card">
            <p>{{ __('Leader dans notre domaine, nous sommes un organisme marocain, acteur de référence en matière de Conseil, d\'Etudes et de Formation.') }}</p>
            <p>{{ __('Avec plus de 20 ans d\'expérience et d\'accompagnement au service de l\'entreprise, nous avons pu développer une expertise et une offre intégrée et pluridisciplinaire.') }}</p>
            <p>{{ __('Notre expertise, portée par plus de 200 consultants et formateurs, justifiant chacun d\'une longue et riche expérience au Maroc et à l\'étranger, constitue aujourd\'hui un véritable gage pour les entreprises que nous accompagnons au quotidien et pour nos partenaires, institutionnels ou privés, qui nous font confiance.') }}</p>
            <p>{{ __('A chacune de nos interventions, nos équipes et nos experts adoptent une démarche à forte valeur ajoutée conforme aux normes internationales, et c\'est cette démarche qui a forgé notre crédibilité et consolidé notre réputation.') }}</p>
        </div>
    </section>

    <section class="values-section">
        <div class="content-section">
            <h2 class="section-title">{{ __('Pourquoi Licorne?') }}</h2>
            <p class="section-subtitle">{{ __('Après plus de 20 ans passés aux côtés des managers marocains et fidèles à nos principes de base, nous pouvons aujourd\'hui parler de la METHODE LICORNE basée sur 6 valeurs :') }}</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lightbulb fa-lg"></i>
                    </div>
                    <h3>{{ __('Innovation') }}</h3>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star fa-lg"></i>
                    </div>
                    <h3>{{ __('Simplicité') }}</h3>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-share-alt fa-lg"></i>
                    </div>
                    <h3>{{ __('Partage') }}</h3>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <h3>{{ __('Proximité') }}</h3>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt fa-lg"></i>
                    </div>
                    <h3>{{ __('Intégrité') }}</h3>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <h3>{{ __('Résultat') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="content-section">
            <h2 class="section-title">{{ __('Dates clés') }}</h2>
            <p class="section-subtitle">{{ __('Les 09 dates clés de Licorne Group') }}</p>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2000</div>
                    <p>{{ __('Création de Licorne – Cabinet de conseil en qualité et organisation') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2005</div>
                    <p>{{ __('Lancement de l\'offre de formation pluridisciplinaire en présentiel') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2007</div>
                    <p>{{ __('Acquisition de la Franchise BERLITZ au Maroc, leader mondial de la formation Linguistique') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2008</div>
                    <p>{{ __('Ouverture du centre Berlitz à Casablanca') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2009</div>
                    <p>{{ __('Ouverture du centre Berlitz à Rabat') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2012</div>
                    <p>{{ __('Lancement de l\'offre e-learning pour nos formations pluridisciplinaires') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2014</div>
                    <p>{{ __('Lancement du pôle conférences et événements') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2018</div>
                    <p>{{ __('Ouverture du centre Berlitz à Tanger') }}</p>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <p>{{ __('Acquisition de la Franchise BERLITZ en France, leader mondial de la formation Linguistique') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <h2 class="section-title">{{ __('Nos métiers') }}</h2>
        <p class="section-subtitle">{{ __('Nos métiers, nos domaines d\'excellence') }}</p>

        <div class="feature-card">
            <p>{{ __('Conseil, Etudes et Formation sont les piliers de l\'activité de Licorne Group. Des métiers dans lesquels nous avons acquis une grande notoriété grâce, notamment, à une démarche réactive et proactive, adossée à une connaissance affinée de l\'environnement dans lequel nous opérons et qui a un impact direct sur les besoins réels de l\'entreprise. Pour ces métiers, nous avons développé une offre adaptée à chaque segment de client avec des prestations personnalisées pour accompagner nos clients et partenaires dans leur quête de performance et croissance soutenue.') }}</p>
        </div>
    </section>


    <section class="testimonials-section">
        <div class="content-section">
            <h2 class="section-title">{{ __('Témoignages') }}</h2>

            <div class="testimonial-card">
                <p class="testimonial-text">{{ __('Notre enseigne exprime son entière satisfaction pour la qualité des prestations et la pertinence des solutions fournies par Licorne Group. Une approche client exemplaire et une grande compétence de l\'équipe des consultants chargés du projet ont permis un déroulement efficace de l\'accompagnement de notre société.') }}</p>
                <div class="testimonial-author">Saâd BENNIS</div>
                <div class="testimonial-position">{{ __('Directeur Général Yatout - Yadeco - Istikbal') }}</div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">{{ __('Dans le cadre du déploiement de la démarche qualité au sein de Marsa Maroc, nous avions travaillé avec le Cabinet Licorne pour nous accompagner sur un de nos sites. Nous avons pu, grâce au professionnalisme et à la qualité des consultants d\'un côté et l\'implication de tous notre personnel à réussir la certification ISO 9001. Le Cabinet Licorne nous a apporté son expertise dans le domaine et nous a permis de mieux structurer notre approche afin de tirer le maximum de profit de ce genre de démarche de progrès.') }}</p>
                <div class="testimonial-author">Fouad LEOUATNI</div>
                <div class="testimonial-position">{{ __('Chef de la Division Qualité - Marsa Maroc') }}</div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">{{ __('« A l\'issue du plan annuel de formation qu\'Holmarcom a mis en place en partenariat avec Licorne, je ne peux qu\'apprécier la qualité des prestations délivrées. Le professionnalisme du Management de Licorne et l\'engagement du staff des intervenants ont répondu favorablement aux attentes des participants. La démarche Formation adoptée a veillé sur l\'équilibre entre la théorie et les cas pratiques spécifiques aux thèmes abordés. Ce qui dénote une excellente pédagogie nécessaire au développement réel des métiers des collaborateurs. La rigueur organisationnelle, la disponibilité et le sens de l\'écoute des membres de Licorne ont manifestement contribué à la réussite de ce plan. Toutes mes félicitations pour la réussite de ce partenariat… »') }}</p>
                <div class="testimonial-author">Driss ZAANOUNE</div>
                <div class="testimonial-position">{{ __('Directeur Ressources Humaines Holmarcom') }}</div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <h2 class="section-title">{{ __('Nos Partenaires') }}</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>BerlitzMaroc</h3>
                <p>{{ __('Spécialisée dans l\'apprentissage de langues basé sur une méthode et une approche particulièrement éprouvée, BERLITZ est une multinationale qui jouit de près d\'un siècle et demi d\'expérience en ce domaine. Le partenariat conclu en 2007 avec Licorne Group, visant à accompagner les entreprises en matière de développement des compétences de leurs équipes, a donné lieu à la création de deux centres de formation à Casablanca et Rabat ainsi qu\'une présence décentralisée à Tanger.') }}</p>
                <a href="https://www.berlitz.com/fr-ma" target="_blank">https://www.berlitz.com/fr-ma</a>
            </div>

            <div class="feature-card">
                <h3>Telelangue</h3>
                <p>{{ __('Des solutions 100% personnalisées avec des cours par téléphone, des classes virtuelles, du coaching ou par Blended Learning, toutes nos solutions sont basées sur un audit de vos compétences de départ pour optimiser votre progression de la langue de votre choix. Conçue pour améliorer votre anglais général du quotidien ou professionnel, notre approche est développée pour vous permettre d\'acquérir des compétences linguistiques solides.') }}</p>
                <p>{{ __('A l\'écrit ou à l\'oral, dans le Tramway avec un programme E-learning évolutif ou avant votre réunion de 15h devant un café avec un professeur dédié, nos méthodes d\'apprentissage interactives, didactiques suivent votre marge de progression pour vous permettre de performer peu importe votre objectif.') }}</p>
            </div>
        </div>
    </section>    <x-footer />
</body>
</html>
