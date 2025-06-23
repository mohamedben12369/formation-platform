<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\ThemeFormation;
use App\Models\Entreprise;
use App\Models\TypeFormation;
use App\Models\StatutFormation;
use App\Models\Domaine;
use App\Models\SousDomaine;
use App\Models\Axe;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FormationStructureSeeder extends Seeder
{    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Créer les entités de base d'abord
            $this->createBaseEntities();
            
            // 2. Créer les formateurs
            $this->createFormateurs();
            
            // 3. Créer les formations avec tous leurs éléments
            $this->createFormations();
        });
    }

    /**
     * Créer les entités de base (domaines, axes, thèmes, entreprises)
     */
    private function createBaseEntities(): void
    {
        // Créer les domaines
        $domaines = [
            'Technologie',
            'Management', 
            'Marketing',
            'Finance',
            'Ressources Humaines',
            'Design',
            'Communication',
            'Commerce',
            'Industrie',
            'Santé'
        ];

        foreach ($domaines as $nomDomaine) {
            Domaine::firstOrCreate(['nom' => $nomDomaine]);
        }

        // Créer les axes
        $axes = [
            ['nom' => 'HARDSKILLS', 'description' => 'Compétences techniques spécialisées'],
            ['nom' => 'SOFTSKILLS', 'description' => 'Compétences comportementales et relationnelles'],
            ['nom' => 'LEADERSHIP', 'description' => 'Compétences de direction et management'],
            ['nom' => 'INNOVATION', 'description' => 'Compétences créatives et d\'innovation']
        ];

        foreach ($axes as $axeData) {
            Axe::firstOrCreate(['nom' => $axeData['nom']], $axeData);
        }

        // Créer les sous-domaines
        $sousDomainesData = [
            ['code' => 'DEVWEB', 'description' => 'Développement Web', 'domaine' => 'Technologie', 'axe' => 'HARDSKILLS'],
            ['code' => 'DEVMOB', 'description' => 'Développement Mobile', 'domaine' => 'Technologie', 'axe' => 'HARDSKILLS'],
            ['code' => 'DATACI', 'description' => 'Data Science et IA', 'domaine' => 'Technologie', 'axe' => 'HARDSKILLS'],
            ['code' => 'CYBER', 'description' => 'Cybersécurité', 'domaine' => 'Technologie', 'axe' => 'HARDSKILLS'],
            ['code' => 'PROJMG', 'description' => 'Gestion de Projet', 'domaine' => 'Management', 'axe' => 'LEADERSHIP'],
            ['code' => 'TEAM', 'description' => 'Management d\'équipe', 'domaine' => 'Management', 'axe' => 'LEADERSHIP'],
            ['code' => 'DIGMAR', 'description' => 'Marketing Digital', 'domaine' => 'Marketing', 'axe' => 'HARDSKILLS'],
            ['code' => 'SOCMED', 'description' => 'Réseaux Sociaux', 'domaine' => 'Marketing', 'axe' => 'SOFTSKILLS'],
            ['code' => 'COMPTA', 'description' => 'Comptabilité', 'domaine' => 'Finance', 'axe' => 'HARDSKILLS'],
            ['code' => 'RECRU', 'description' => 'Recrutement', 'domaine' => 'Ressources Humaines', 'axe' => 'SOFTSKILLS'],
            ['code' => 'UXUI', 'description' => 'UX/UI Design', 'domaine' => 'Design', 'axe' => 'INNOVATION'],
            ['code' => 'GRAPH', 'description' => 'Design Graphique', 'domaine' => 'Design', 'axe' => 'INNOVATION']
        ];

        foreach ($sousDomainesData as $sousDomaineData) {
            $domaine = Domaine::where('nom', $sousDomaineData['domaine'])->first();
            $axe = Axe::where('nom', $sousDomaineData['axe'])->first();
            
            if ($domaine && $axe) {
                SousDomaine::firstOrCreate(
                    ['code' => $sousDomaineData['code']], 
                    [
                        'description' => $sousDomaineData['description'],
                        'domaine_code' => $domaine->id,
                        'axes_id' => $axe->id
                    ]
                );
            }
        }

        // Créer les thèmes de formation
        $this->createThemesFormation();

        // Créer les types et statuts de formation
        $this->createTypesEtStatuts();

        // Créer les entreprises
        $this->createEntreprises();
    }

    /**
     * Créer les thèmes de formation
     */
    private function createThemesFormation(): void
    {
        $themes = [
            [
                'titre' => 'Développement Frontend avec React',
                'sous_domaine_code' => 'DEVWEB',
                'prix' => 1800.00,
                'duree' => 40,
                'prerequis' => 'HTML, CSS, JavaScript de base',
                'competence_visees' => 'Maîtrise de React.js, Redux, Hooks, composants réutilisables'
            ],
            [
                'titre' => 'Développement Backend avec Node.js',
                'sous_domaine_code' => 'DEVWEB',
                'prix' => 2000.00,
                'duree' => 45,
                'prerequis' => 'JavaScript, bases de données',
                'competence_visees' => 'API REST, Express.js, authentification, sécurité backend'
            ],
            [
                'titre' => 'Bases de données NoSQL',
                'sous_domaine_code' => 'DEVWEB',
                'prix' => 1200.00,
                'duree' => 25,
                'prerequis' => 'Bases de données relationnelles',
                'competence_visees' => 'MongoDB, Redis, optimisation des requêtes NoSQL'
            ],
            [
                'titre' => 'Git et Collaboration',
                'sous_domaine_code' => 'DEVWEB',
                'prix' => 800.00,
                'duree' => 15,
                'prerequis' => 'Développement de base',
                'competence_visees' => 'Versioning, travail en équipe, CI/CD'
            ],
            [
                'titre' => 'Gestion de Projet Agile',
                'sous_domaine_code' => 'PROJMG',
                'prix' => 1500.00,
                'duree' => 30,
                'prerequis' => 'Expérience en gestion de projet',
                'competence_visees' => 'Scrum, Kanban, facilitation d\'équipe'
            ],
            [
                'titre' => 'Leadership et Communication',
                'sous_domaine_code' => 'TEAM',
                'prix' => 1400.00,
                'duree' => 25,
                'prerequis' => 'Expérience managériale',
                'competence_visees' => 'Leadership authentique, communication efficace'
            ],
            [
                'titre' => 'Outils de Productivité',
                'sous_domaine_code' => 'PROJMG',
                'prix' => 900.00,
                'duree' => 20,
                'prerequis' => 'Bureautique de base',
                'competence_visees' => 'Outils collaboratifs, automation, efficacité'
            ],
            [
                'titre' => 'SEO et Référencement',
                'sous_domaine_code' => 'DIGMAR',
                'prix' => 1300.00,
                'duree' => 28,
                'prerequis' => 'Bases du web',
                'competence_visees' => 'Optimisation SEO, analyse de performance'
            ],
            [
                'titre' => 'Marketing des Réseaux Sociaux',
                'sous_domaine_code' => 'SOCMED',
                'prix' => 1100.00,
                'duree' => 22,
                'prerequis' => 'Marketing digital de base',
                'competence_visees' => 'Stratégie social media, engagement, analytics'
            ],
            [
                'titre' => 'E-commerce et Vente en Ligne',
                'sous_domaine_code' => 'DIGMAR',
                'prix' => 1600.00,
                'duree' => 35,
                'prerequis' => 'Marketing digital',
                'competence_visees' => 'Plateformes e-commerce, conversion, paiement'
            ],
            [
                'titre' => 'Analytics et Mesure de Performance',
                'sous_domaine_code' => 'DIGMAR',
                'prix' => 1250.00,
                'duree' => 30,
                'prerequis' => 'Marketing digital',
                'competence_visees' => 'Google Analytics, KPIs, reporting'
            ],
            [
                'titre' => 'Fondamentaux du Machine Learning',
                'sous_domaine_code' => 'DATACI',
                'prix' => 2200.00,
                'duree' => 50,
                'prerequis' => 'Python, mathématiques',
                'competence_visees' => 'Algorithmes ML, scikit-learn, modélisation'
            ],
            [
                'titre' => 'Deep Learning et Réseaux de Neurones',
                'sous_domaine_code' => 'DATACI',
                'prix' => 2500.00,
                'duree' => 55,
                'prerequis' => 'Machine Learning, Python avancé',
                'competence_visees' => 'TensorFlow, PyTorch, CNN, RNN'
            ],
            [
                'titre' => 'Computer Vision',
                'sous_domaine_code' => 'DATACI',
                'prix' => 2000.00,
                'duree' => 45,
                'prerequis' => 'Deep Learning',
                'competence_visees' => 'Traitement d\'images, reconnaissance, OpenCV'
            ],
            [
                'titre' => 'Traitement du Langage Naturel',
                'sous_domaine_code' => 'DATACI',
                'prix' => 1900.00,
                'duree' => 40,
                'prerequis' => 'Machine Learning',
                'competence_visees' => 'NLP, tokenisation, modèles de langage'
            ],
            [
                'titre' => 'Comptabilité Générale Avancée',
                'sous_domaine_code' => 'COMPTA',
                'prix' => 1400.00,
                'duree' => 35,
                'prerequis' => 'Comptabilité de base',
                'competence_visees' => 'États financiers, consolidation, normes IFRS'
            ],
            [
                'titre' => 'Gestion Budgétaire et Prévisionnelle',
                'sous_domaine_code' => 'COMPTA',
                'prix' => 1200.00,
                'duree' => 30,
                'prerequis' => 'Comptabilité générale',
                'competence_visees' => 'Budget, prévisions, contrôle de gestion'
            ],
            [
                'titre' => 'Fiscalité des Entreprises',
                'sous_domaine_code' => 'COMPTA',
                'prix' => 1300.00,
                'duree' => 28,
                'prerequis' => 'Droit des affaires',
                'competence_visees' => 'TVA, IS, optimisation fiscale'
            ],
            [
                'titre' => 'Audit et Contrôle de Gestion',
                'sous_domaine_code' => 'COMPTA',
                'prix' => 1600.00,
                'duree' => 32,
                'prerequis' => 'Comptabilité avancée',
                'competence_visees' => 'Procédures d\'audit, contrôle interne, risques'
            ],
            [
                'titre' => 'Ethical Hacking et Penetration Testing',
                'sous_domaine_code' => 'CYBER',
                'prix' => 2300.00,
                'duree' => 50,
                'prerequis' => 'Réseaux, systèmes',
                'competence_visees' => 'Tests d\'intrusion, vulnérabilités, sécurisation'
            ],
            [
                'titre' => 'Sécurité des Réseaux',
                'sous_domaine_code' => 'CYBER',
                'prix' => 1800.00,
                'duree' => 40,
                'prerequis' => 'Administration réseau',
                'competence_visees' => 'Firewalls, VPN, détection d\'intrusion'
            ],
            [
                'titre' => 'Cryptographie et Sécurité des Données',
                'sous_domaine_code' => 'CYBER',
                'prix' => 1700.00,
                'duree' => 35,
                'prerequis' => 'Mathématiques, sécurité',
                'competence_visees' => 'Chiffrement, PKI, protection des données'
            ],
            [
                'titre' => 'Gestion des Incidents de Sécurité',
                'sous_domaine_code' => 'CYBER',
                'prix' => 1500.00,
                'duree' => 30,
                'prerequis' => 'Sécurité informatique',
                'competence_visees' => 'Réponse aux incidents, forensic, continuité'
            ],
            [
                'titre' => 'Recrutement et Sélection',
                'sous_domaine_code' => 'RECRU',
                'prix' => 1200.00,
                'duree' => 25,
                'prerequis' => 'RH de base',
                'competence_visees' => 'Sourcing, entretiens, évaluation candidats'
            ],
            [
                'titre' => 'Formation et Développement',
                'sous_domaine_code' => 'RECRU',
                'prix' => 1100.00,
                'duree' => 22,
                'prerequis' => 'Gestion RH',
                'competence_visees' => 'Ingénierie pédagogique, parcours développement'
            ],
            [
                'titre' => 'Management et Leadership',
                'sous_domaine_code' => 'TEAM',
                'prix' => 1400.00,
                'duree' => 28,
                'prerequis' => 'Expérience managériale',
                'competence_visees' => 'Styles de management, motivation, délégation'
            ],
            [
                'titre' => 'Droit Social et Paie',
                'sous_domaine_code' => 'RECRU',
                'prix' => 1300.00,
                'duree' => 30,
                'prerequis' => 'Droit du travail',
                'competence_visees' => 'Gestion de la paie, conformité, contentieux'
            ],
            [
                'titre' => 'Design Graphique et Identité Visuelle',
                'sous_domaine_code' => 'GRAPH',
                'prix' => 1500.00,
                'duree' => 35,
                'prerequis' => 'Bases du design',
                'competence_visees' => 'Photoshop, Illustrator, charte graphique'
            ],
            [
                'titre' => 'UX Research et Design Thinking',
                'sous_domaine_code' => 'UXUI',
                'prix' => 1600.00,
                'duree' => 32,
                'prerequis' => 'Design ou marketing',
                'competence_visees' => 'Recherche utilisateur, personas, parcours client'
            ],
            [
                'titre' => 'UI Design et Prototypage',
                'sous_domaine_code' => 'UXUI',
                'prix' => 1400.00,
                'duree' => 30,
                'prerequis' => 'UX Research',
                'competence_visees' => 'Figma, Sketch, maquettes interactives'
            ],
            [
                'titre' => 'Design Mobile et Responsive',
                'sous_domaine_code' => 'UXUI',
                'prix' => 1300.00,
                'duree' => 28,
                'prerequis' => 'UI Design',
                'competence_visees' => 'Design mobile-first, adaptabilité, accessibilité'
            ]
        ];        foreach ($themes as $themeData) {
            $sousDomaine = SousDomaine::where('code', $themeData['sous_domaine_code'])->first();
            if ($sousDomaine) {
                ThemeFormation::firstOrCreate(
                    ['titre' => $themeData['titre']], 
                    [
                        'sous_domaine_code' => $themeData['sous_domaine_code'],
                        'axes_id' => $sousDomaine->axes_id,
                        'prix' => $themeData['prix'],
                        'duree' => $themeData['duree'],
                        'prerequis' => $themeData['prerequis'],
                        'competence_visees' => $themeData['competence_visees']
                    ]
                );
            }
        }
    }

    /**
     * Créer les types et statuts de formation
     */
    private function createTypesEtStatuts(): void
    {
        $typesFormation = [
            ['nom' => 'Certifiante'],
            ['nom' => 'Diplômante'],
            ['nom' => 'Qualifiante'],
            ['nom' => 'Continue'],
            ['nom' => 'Intensive']
        ];

        foreach ($typesFormation as $type) {
            TypeFormation::firstOrCreate($type);
        }

        $statutsFormation = [
            ['nom' => 'Programmée'],
            ['nom' => 'En cours'],
            ['nom' => 'Terminée'],
            ['nom' => 'Annulée'],
            ['nom' => 'Reportée']
        ];

        foreach ($statutsFormation as $statut) {
            StatutFormation::firstOrCreate($statut, ['code' => strtoupper(substr($statut['nom'], 0, 3)), 'dateCreation' => now()]);
        }
    }    /**
     * Créer les entreprises
     */
    private function createEntreprises(): void
    {
        $entreprises = [
            [
                'nom' => 'TechnoFormation SARL',
                'email' => 'contact@technoformation.sn',
                'Adresse' => 'Rue 10 x Avenue Bourguiba, Dakar',
                'tel' => '+221 33 824 15 67',
                'fax' => '+221 33 824 15 68',
                'CNSS' => '12345678901',
                'user_email' => 'manager@technoformation.sn',
                'IF' => 'IF2025001',
                'RC' => 'RC2025001',
                'ICE' => 'ICE2025001',
                'patente' => 'PAT2025001',
                'date_creation' => '2020-01-15'
            ],
            [
                'nom' => 'Excellence Formation',
                'email' => 'info@excellence-formation.com',
                'Adresse' => 'Avenue Léopold Sédar Senghor, Thiès',
                'tel' => '+221 33 951 23 45',
                'fax' => '+221 33 951 23 46',
                'CNSS' => '23456789012',
                'user_email' => 'contact@excellence-formation.com',
                'IF' => 'IF2025002',
                'RC' => 'RC2025002',
                'ICE' => 'ICE2025002',
                'patente' => 'PAT2025002',
                'date_creation' => '2019-06-20'
            ],
            [
                'nom' => 'DigiMarketing Pro',
                'email' => 'contact@digimarketing.sn',
                'Adresse' => 'Boulevard de la République, Dakar Plateau',
                'tel' => '+221 33 889 67 23',
                'fax' => '+221 33 889 67 24',
                'CNSS' => '34567890123',
                'user_email' => 'admin@digimarketing.sn',
                'IF' => 'IF2025003',
                'RC' => 'RC2025003',
                'ICE' => 'ICE2025003',
                'patente' => 'PAT2025003',
                'date_creation' => '2021-04-10'
            ],
            [
                'nom' => 'AI Excellence Center',
                'email' => 'info@ai-excellence.edu.sn',
                'Adresse' => 'Campus UCAD, Fann, Dakar',
                'tel' => '+221 33 824 69 81',
                'fax' => '+221 33 824 69 82',
                'CNSS' => '45678901234',
                'user_email' => 'admin@ai-excellence.edu.sn',
                'IF' => 'IF2025004',
                'RC' => 'RC2025004',
                'ICE' => 'ICE2025004',
                'patente' => 'PAT2025004',
                'date_creation' => '2018-09-30'
            ],
            [
                'nom' => 'Cabinet Expertise Comptable',
                'email' => 'cabinet@expertise-compta.sn',
                'Adresse' => 'Rue Carnot, Dakar',
                'tel' => '+221 33 821 54 76',
                'fax' => '+221 33 821 54 77',
                'CNSS' => '56789012345',
                'user_email' => 'admin@expertise-compta.sn',
                'IF' => 'IF2025005',
                'RC' => 'RC2025005',
                'ICE' => 'ICE2025005',
                'patente' => 'PAT2025005',
                'date_creation' => '2017-11-12'
            ],
            [
                'nom' => 'SecureTech Solutions',
                'email' => 'security@securetech.sn',
                'Adresse' => 'Route des Almadies, Ngor',
                'tel' => '+221 33 864 78 92',
                'fax' => '+221 33 864 78 93',
                'CNSS' => '67890123456',
                'user_email' => 'admin@securetech.sn',
                'IF' => 'IF2025006',
                'RC' => 'RC2025006',
                'ICE' => 'ICE2025006',
                'patente' => 'PAT2025006',
                'date_creation' => '2020-03-25'
            ],
            [
                'nom' => 'RH Excellence SARL',
                'email' => 'contact@rh-excellence.com',
                'Adresse' => 'Mermoz Pyrotechnie, Dakar',
                'tel' => '+221 33 864 12 34',
                'fax' => '+221 33 864 12 35',
                'CNSS' => '78901234567',
                'user_email' => 'admin@rh-excellence.com',
                'IF' => 'IF2025007',
                'RC' => 'RC2025007',
                'ICE' => 'ICE2025007',
                'patente' => 'PAT2025007',
                'date_creation' => '2019-07-08'
            ],
            [
                'nom' => 'Creative Agency Dakar',
                'email' => 'hello@creative-agency.sn',
                'Adresse' => 'Sacré-Cœur 3, Dakar',
                'tel' => '+221 33 869 45 67',
                'fax' => '+221 33 869 45 68',
                'CNSS' => '89012345678',
                'user_email' => 'admin@creative-agency.sn',
                'IF' => 'IF2025008',
                'RC' => 'RC2025008',
                'ICE' => 'ICE2025008',
                'patente' => 'PAT2025008',
                'date_creation' => '2021-12-02'
            ]
        ];

        foreach ($entreprises as $entrepriseData) {
            // Récupérer l'utilisateur associé
            $user = User::where('email', $entrepriseData['user_email'])->first();
            $userId = $user ? $user->id : null;

            // Créer l'entreprise sans l'email de l'utilisateur
            unset($entrepriseData['user_email']);
            $entrepriseData['user_id'] = $userId;

            Entreprise::firstOrCreate(['nom' => $entrepriseData['nom']], $entrepriseData);
        }
    }    /**
     * Créer les formateurs
     */
    private function createFormateurs(): void
    {
        // Créer les rôles nécessaires
        $roleFormateur = Role::firstOrCreate(['nom' => 'Formateur'], [
            'permession' => 'formation.teach',
            'color' => 'success',
            'icon' => 'fas fa-chalkboard-teacher'
        ]);

        $roleEntreprise = Role::firstOrCreate(['nom' => 'Entreprise'], [
            'permession' => 'entreprise.manage',
            'color' => 'primary',
            'icon' => 'fas fa-building'
        ]);

        // Récupérer une question de sécurité
        $questionSecurite = DB::table('securite_question')->first();
        $questionId = $questionSecurite ? $questionSecurite->id : 1;

        $formateurs = [
            [
                'nom' => 'Diop',
                'prenom' => 'Mamadou',
                'email' => 'mamadou.diop@formation.sn',
                'tel' => '+221 77 123 45 67',
                'date_de_naissance' => '1985-03-15',
                'specialite' => 'Développement Web'
            ],
            [
                'nom' => 'Fall',
                'prenom' => 'Aissatou',
                'email' => 'aissatou.fall@formation.sn',
                'tel' => '+221 76 234 56 78',
                'date_de_naissance' => '1988-07-22',
                'specialite' => 'Intelligence Artificielle'
            ],
            [
                'nom' => 'Seck',
                'prenom' => 'Ibrahima',
                'email' => 'ibrahima.seck@formation.sn',
                'tel' => '+221 78 345 67 89',
                'date_de_naissance' => '1982-11-08',
                'specialite' => 'Gestion de Projet'
            ],
            [
                'nom' => 'Ndiaye',
                'prenom' => 'Fatou',
                'email' => 'fatou.ndiaye@formation.sn',
                'tel' => '+221 77 456 78 90',
                'date_de_naissance' => '1987-05-12',
                'specialite' => 'Marketing Digital'
            ],
            [
                'nom' => 'Ba',
                'prenom' => 'Ousmane',
                'email' => 'ousmane.ba@formation.sn',
                'tel' => '+221 76 567 89 01',
                'date_de_naissance' => '1984-09-25',
                'specialite' => 'Cybersécurité'
            ],
            [
                'nom' => 'Thiam',
                'prenom' => 'Mariama',
                'email' => 'mariama.thiam@formation.sn',
                'tel' => '+221 78 678 90 12',
                'date_de_naissance' => '1986-02-18',
                'specialite' => 'Comptabilité'
            ],
            [
                'nom' => 'Gueye',
                'prenom' => 'Abdoulaye',
                'email' => 'abdoulaye.gueye@formation.sn',
                'tel' => '+221 77 789 01 23',
                'date_de_naissance' => '1983-08-30',
                'specialite' => 'Ressources Humaines'
            ],
            [
                'nom' => 'Sarr',
                'prenom' => 'Aminata',
                'email' => 'aminata.sarr@formation.sn',
                'tel' => '+221 76 890 12 34',
                'date_de_naissance' => '1989-12-05',
                'specialite' => 'Design UX/UI'
            ]
        ];        foreach ($formateurs as $formateurData) {
            User::firstOrCreate(
                ['email' => $formateurData['email']], 
                [
                    'nom' => $formateurData['nom'],
                    'prenom' => $formateurData['prenom'],
                    'tel' => $formateurData['tel'],
                    'date_de_naissance' => $formateurData['date_de_naissance'],
                    'role_id' => $roleFormateur->id,
                    'password' => Hash::make('password123'),
                    'reponse' => 'Ma réponse de sécurité',
                    'securite_question_id' => $questionId,
                    'is_active' => true
                ]
            );
        }

        // Créer des utilisateurs pour les entreprises
        $usersEntreprises = [
            [
                'nom' => 'TechnoFormation',
                'prenom' => 'Manager',
                'email' => 'manager@technoformation.sn',
                'tel' => '+221 33 824 15 67',
                'date_de_naissance' => '1980-01-15'
            ],
            [
                'nom' => 'Excellence',
                'prenom' => 'Formation',
                'email' => 'contact@excellence-formation.com',
                'tel' => '+221 33 951 23 45',
                'date_de_naissance' => '1978-06-20'
            ],
            [
                'nom' => 'DigiMarketing',
                'prenom' => 'Pro',
                'email' => 'admin@digimarketing.sn',
                'tel' => '+221 33 889 67 23',
                'date_de_naissance' => '1982-04-10'
            ],
            [
                'nom' => 'AI Excellence',
                'prenom' => 'Center',
                'email' => 'admin@ai-excellence.edu.sn',
                'tel' => '+221 33 824 69 81',
                'date_de_naissance' => '1975-09-30'
            ],
            [
                'nom' => 'Expertise',
                'prenom' => 'Comptable',
                'email' => 'admin@expertise-compta.sn',
                'tel' => '+221 33 821 54 76',
                'date_de_naissance' => '1979-11-12'
            ],
            [
                'nom' => 'SecureTech',
                'prenom' => 'Solutions',
                'email' => 'admin@securetech.sn',
                'tel' => '+221 33 864 78 92',
                'date_de_naissance' => '1981-03-25'
            ],
            [
                'nom' => 'RH Excellence',
                'prenom' => 'SARL',
                'email' => 'admin@rh-excellence.com',
                'tel' => '+221 33 864 12 34',
                'date_de_naissance' => '1983-07-08'
            ],
            [
                'nom' => 'Creative Agency',
                'prenom' => 'Dakar',
                'email' => 'admin@creative-agency.sn',
                'tel' => '+221 33 869 45 67',
                'date_de_naissance' => '1985-12-02'
            ]
        ];

        foreach ($usersEntreprises as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']], 
                [
                    'nom' => $userData['nom'],
                    'prenom' => $userData['prenom'],
                    'tel' => $userData['tel'],
                    'date_de_naissance' => $userData['date_de_naissance'],                    'role_id' => $roleEntreprise->id,
                    'password' => Hash::make('password123'),
                    'reponse' => 'Ma réponse de sécurité entreprise',
                    'securite_question_id' => $questionId,
                    'is_active' => true                ]
            );
        }
    }

    /**
     * Créer les formations
     */
    private function createFormations(): void
    {
        $formations = [
            [
                'nom' => 'Formation Développement Web Full Stack',
                'description' => 'Formation complète pour devenir développeur web full stack avec React, Node.js et bases de données.',
                'dateDebut' => '2025-07-01',
                'dateFin' => '2025-12-15',
                'lieu' => 'Centre de Formation Techno - Dakar',
                'nombre_ouvriers' => 25,
                'nombre_encadrants' => 8,
                'nombre_cadres' => 5,
                'duree' => 160,
                'moyennes' => 'Projets pratiques, évaluations continues, portfolio professionnel',
                'programme' => 'HTML/CSS, JavaScript, React.js, Node.js, Express, MongoDB, Git, DevOps, API REST, Tests unitaires',
                'objectifs' => 'Maîtriser le développement web moderne, créer des applications complètes, travailler en équipe sur des projets réels',
                'type_formation' => 'Certifiante',
                'statut' => 'Programmée',
                'domaine' => 'Technologie',
                'entreprise' => 'TechnoFormation SARL',
                'themes' => [
                    'Développement Frontend avec React',
                    'Développement Backend avec Node.js',
                    'Bases de données NoSQL',
                    'Git et Collaboration'
                ]
            ],
            [
                'nom' => 'Formation Gestion de Projet Agile',
                'description' => 'Apprenez les méthodologies agiles Scrum et Kanban pour gérer efficacement vos projets.',
                'dateDebut' => '2025-06-25',
                'dateFin' => '2025-08-30',
                'lieu' => 'Institut de Management - Thiès',
                'nombre_ouvriers' => 20,
                'nombre_encadrants' => 6,
                'nombre_cadres' => 4,
                'duree' => 80,
                'moyennes' => 'Simulations de projets, études de cas, certification Scrum Master',
                'programme' => 'Principes Agile, Scrum Framework, Kanban, Outils de gestion, Leadership, Communication',
                'objectifs' => 'Devenir Scrum Master certifié, gérer des équipes agiles, optimiser les processus de développement',
                'type_formation' => 'Diplômante',
                'statut' => 'En cours',
                'domaine' => 'Management',
                'entreprise' => 'Excellence Formation',
                'themes' => [
                    'Gestion de Projet Agile',
                    'Leadership et Communication',
                    'Outils de Productivité'
                ]
            ],
            [
                'nom' => 'Formation Marketing Digital et E-commerce',
                'description' => 'Formation complète en marketing digital avec focus sur le e-commerce et les réseaux sociaux.',
                'dateDebut' => '2025-08-15',
                'dateFin' => '2025-11-30',
                'lieu' => 'Digital Campus - Dakar Plateau',
                'nombre_ouvriers' => 30,
                'nombre_encadrants' => 10,
                'nombre_cadres' => 6,
                'duree' => 120,
                'moyennes' => 'Projets de campagnes réelles, analyses de performance, certification Google Ads',
                'programme' => 'SEO/SEA, Réseaux sociaux, Content marketing, E-commerce, Analytics, Email marketing, Publicité en ligne',
                'objectifs' => 'Maîtriser le marketing digital, créer des stratégies efficaces, augmenter la visibilité en ligne',
                'type_formation' => 'Certifiante',
                'statut' => 'Programmée',
                'domaine' => 'Marketing',
                'entreprise' => 'DigiMarketing Pro',
                'themes' => [
                    'SEO et Référencement',
                    'Marketing des Réseaux Sociaux',
                    'E-commerce et Vente en Ligne',
                    'Analytics et Mesure de Performance'
                ]
            ],
            [
                'nom' => 'Formation Intelligence Artificielle et Machine Learning',
                'description' => 'Découvrez l\'IA et le machine learning avec Python, TensorFlow et des applications pratiques.',
                'dateDebut' => '2025-09-01',
                'dateFin' => '2026-02-28',
                'lieu' => 'Centre d\'Excellence IA - Université Cheikh Anta Diop',
                'nombre_ouvriers' => 15,
                'nombre_encadrants' => 8,
                'nombre_cadres' => 5,
                'duree' => 200,
                'moyennes' => 'Projets de recherche, développement de modèles IA, présentation de résultats',
                'programme' => 'Python, NumPy, Pandas, Scikit-learn, TensorFlow, Deep Learning, Computer Vision, NLP, Ethics AI',
                'objectifs' => 'Comprendre les concepts de l\'IA, développer des modèles ML, appliquer l\'IA à des problèmes réels',
                'type_formation' => 'Diplômante',
                'statut' => 'Programmée',
                'domaine' => 'Technologie',
                'entreprise' => 'AI Excellence Center',
                'themes' => [
                    'Fondamentaux du Machine Learning',
                    'Deep Learning et Réseaux de Neurones',
                    'Computer Vision',
                    'Traitement du Langage Naturel'
                ]
            ],
            [
                'nom' => 'Formation Comptabilité et Gestion Financière',
                'description' => 'Formation approfondie en comptabilité générale, analytique et gestion financière d\'entreprise.',
                'dateDebut' => '2025-07-10',
                'dateFin' => '2025-12-20',
                'lieu' => 'École Supérieure de Commerce - Dakar',
                'nombre_ouvriers' => 25,
                'nombre_encadrants' => 7,
                'nombre_cadres' => 4,
                'duree' => 140,
                'moyennes' => 'Examens théoriques, travaux pratiques sur logiciels, stage en entreprise',
                'programme' => 'Comptabilité générale, Comptabilité analytique, Gestion budgétaire, Fiscalité, Audit, Logiciels comptables',
                'objectifs' => 'Maîtriser les techniques comptables, gérer les finances d\'une entreprise, préparer aux certifications',
                'type_formation' => 'Diplômante',
                'statut' => 'Programmée',
                'domaine' => 'Finance',
                'entreprise' => 'Cabinet Expertise Comptable',
                'themes' => [
                    'Comptabilité Générale Avancée',
                    'Gestion Budgétaire et Prévisionnelle',
                    'Fiscalité des Entreprises',
                    'Audit et Contrôle de Gestion'
                ]
            ],
            [
                'nom' => 'Formation Cybersécurité et Sécurité Informatique',
                'description' => 'Formation spécialisée en cybersécurité pour protéger les systèmes et données d\'entreprise.',
                'dateDebut' => '2025-08-01',
                'dateFin' => '2025-12-15',
                'lieu' => 'CyberSec Academy - Almadies',
                'nombre_ouvriers' => 18,
                'nombre_encadrants' => 6,
                'nombre_cadres' => 4,
                'duree' => 160,
                'moyennes' => 'Labs pratiques, simulations d\'attaques, certifications sécurité',
                'programme' => 'Ethical Hacking, Pentesting, Forensic, Cryptographie, Sécurité réseau, Incident Response, Compliance',
                'objectifs' => 'Devenir expert en cybersécurité, protéger les infrastructures, gérer les incidents de sécurité',
                'type_formation' => 'Certifiante',
                'statut' => 'Programmée',
                'domaine' => 'Technologie',
                'entreprise' => 'SecureTech Solutions',
                'themes' => [
                    'Ethical Hacking et Penetration Testing',
                    'Sécurité des Réseaux',
                    'Cryptographie et Sécurité des Données',
                    'Gestion des Incidents de Sécurité'
                ]
            ],
            [
                'nom' => 'Formation Ressources Humaines et Management',
                'description' => 'Formation complète en GRH moderne avec focus sur le management d\'équipes et le développement RH.',
                'dateDebut' => '2025-06-30',
                'dateFin' => '2025-11-15',
                'lieu' => 'Institut RH Excellence - Mermoz',
                'nombre_ouvriers' => 22,
                'nombre_encadrants' => 8,
                'nombre_cadres' => 5,
                'duree' => 110,
                'moyennes' => 'Études de cas RH, projets de transformation, évaluations comportementales',
                'programme' => 'Recrutement, Formation, GPEC, Paie, Droit social, Management, Leadership, Communication RH',
                'objectifs' => 'Maîtriser les fonctions RH, manager des équipes, optimiser les processus RH',
                'type_formation' => 'Diplômante',
                'statut' => 'En cours',
                'domaine' => 'Ressources Humaines',
                'entreprise' => 'RH Excellence SARL',
                'themes' => [
                    'Recrutement et Sélection',
                    'Formation et Développement',
                    'Management et Leadership',
                    'Droit Social et Paie'
                ]
            ],
            [
                'nom' => 'Formation Design Graphique et UX/UI',
                'description' => 'Formation créative en design graphique avec spécialisation UX/UI pour applications web et mobile.',
                'dateDebut' => '2025-09-15',
                'dateFin' => '2026-01-30',
                'lieu' => 'Creative Design Studio - Sacré-Cœur',
                'nombre_ouvriers' => 20,
                'nombre_encadrants' => 6,
                'nombre_cadres' => 3,
                'duree' => 130,
                'moyennes' => 'Portfolio créatif, projets clients réels, présentation de concepts',
                'programme' => 'Photoshop, Illustrator, Figma, UX Research, UI Design, Prototypage, Design Thinking, Branding',
                'objectifs' => 'Devenir designer professionnel, créer des interfaces utilisateur, maîtriser les outils de design',
                'type_formation' => 'Certifiante',
                'statut' => 'Programmée',
                'domaine' => 'Design',                'entreprise' => 'Creative Agency Dakar',
                'themes' => [
                    'Design Graphique et Identité Visuelle',
                    'UX Research et Design Thinking',
                    'UI Design et Prototypage',
                    'Design Mobile et Responsive'
                ]
            ]
        ];

        foreach ($formations as $formationData) {
            $this->createFormation($formationData);
        }
    }

    private function createFormation($data)
    {
        // Récupérer ou créer les entités liées
        $typeFormation = TypeFormation::firstOrCreate(['nom' => $data['type_formation']]);
        $statutFormation = StatutFormation::firstOrCreate(['nom' => $data['statut']], ['code' => strtoupper(substr($data['statut'], 0, 3)), 'dateCreation' => now()]);
        $domaine = Domaine::firstOrCreate(['nom' => $data['domaine']]);
        $entreprise = Entreprise::where('nom', $data['entreprise'])->first();
        
        if (!$entreprise) {
            $entreprise = Entreprise::firstOrCreate([
                'nom' => $data['entreprise'],
                'Adresse' => 'Adresse de ' . $data['entreprise'],
                'tel' => '+221 33 XXX XX XX',
                'email' => strtolower(str_replace(' ', '', $data['entreprise'])) . '@email.com'
            ]);
        }

        // Créer la formation
        $formation = Formation::create([
            'nom' => $data['nom'],
            'dateDebut' => $data['dateDebut'],
            'dateFin' => $data['dateFin'],
            'lieu' => $data['lieu'],
            'nombre_ouvriers' => $data['nombre_ouvriers'],
            'nombre_encadrants' => $data['nombre_encadrants'],
            'nombre_cadres' => $data['nombre_cadres'],
            'duree' => $data['duree'],
            'moyennes' => $data['moyennes'],
            'programme' => $data['programme'],
            'objectifs' => $data['objectifs'],
            'type_formation_id' => $typeFormation->id,
            'statut_formation_id' => $statutFormation->id,
            'domaine_id' => $domaine->id,
            'entreprise_id' => $entreprise->id,
            'DatedeCreation' => now(),        ]);

        // Attacher les thèmes avec des prix et durées réalistes
        foreach ($data['themes'] as $index => $themeName) {
            $theme = ThemeFormation::where('titre', $themeName)->first();
            
            if ($theme) {
                // Calculer des prix et durées proportionnels
                $dureeTheme = rand(15, 50);
                $prixTheme = rand(800, 2500);
                
                $formation->themes()->attach($theme->idtheme, [
                    'prix' => $prixTheme,
                    'duree_heures' => $dureeTheme,
                    'date_debut' => null,
                    'date_fin' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Attacher des formateurs aléatoires à la formation
        $formateurs = User::whereHas('role', function($query) {
            $query->where('nom', 'Formateur');
        })->get();

        if ($formateurs->count() > 0) {
            // Attacher 1 à 3 formateurs aléatoires
            $nombreFormateurs = rand(1, min(3, $formateurs->count()));
            $formateursSelectionnes = $formateurs->random($nombreFormateurs);
            
            foreach ($formateursSelectionnes as $formateur) {
                $formation->formateurs()->attach($formateur->id);
            }
        }

        // Mettre à jour la durée et les prérequis de la formation
        $formation->load('themes');
        $formation->updateFromThemes();
    }
}
