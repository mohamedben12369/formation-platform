<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run(): void
    {        // Vérifier si des formations existent déjà
        if (DB::table('formations')->count() > 0) {
            $this->command->info('Des formations existent déjà. Ajout de nouvelles formations...');
        }

        // Récupérer les IDs des tables liées
        $typeFormations = DB::table('type_formations')->pluck('id')->toArray();
        if (empty($typeFormations)) {
            $this->command->error('Aucun type de formation trouvé. Veuillez d\'abord exécuter TypeFormationSeeder.');
            return;
        }
        
        $statutFormations = DB::table('statut_formations')->pluck('id')->toArray();
        if (empty($statutFormations)) {
            $this->command->error('Aucun statut de formation trouvé. Veuillez d\'abord exécuter StatutFormationSeeder.');
            return;
        }
        
        $domaines = DB::table('domaines')->pluck('id')->toArray();
        if (empty($domaines)) {
            $this->command->error('Aucun domaine trouvé. Veuillez d\'abord exécuter DomaineSeeder.');
            return;
        }
        
        $entreprises = DB::table('entreprises')->pluck('id')->toArray();
        if (empty($entreprises)) {
            $this->command->warn('Aucune entreprise trouvée. Les formations seront créées sans entreprise.');
            $entreprises = [null]; // Permettre null car le champ est nullable
        }
        
        $now = Carbon::now();
        
        // Données de formations réalistes
        $formationsData = [
            [
                'nom' => 'Formation en Développement Web Moderne',
                'lieu' => 'Centre de Formation TechPro - Paris',
                'duree' => '8 semaines',
                'programme' => "Module 1: Introduction au HTML5 et CSS3\nModule 2: JavaScript ES6+ et TypeScript\nModule 3: Frameworks Frontend (React, Vue.js)\nModule 4: Backend avec Node.js\nModule 5: Bases de données (MySQL, MongoDB)\nModule 6: Déploiement et DevOps\nModule 7: Tests et qualité du code\nModule 8: Projet final",
                'objectifs' => "• Maîtriser les technologies web modernes\n• Développer des applications web complètes\n• Comprendre les bonnes pratiques de développement\n• Être capable de travailler en équipe sur des projets complexes\n• Préparer aux certifications professionnelles",
                'prerequis' => "• Connaissances de base en informatique\n• Notions de logique et d'algorithmique\n• Motivation et disponibilité pour un apprentissage intensif\n• Ordinateur portable avec accès internet",                'moyennes' => '16.5/20',
                'image' => 'formations/web-development.jpg',
                'document_pdf' => 'formations/programme-web-dev.pdf'
            ],
            [
                'nom' => 'Formation Management et Leadership',
                'lieu' => 'Institut de Formation Executive - Lyon',
                'duree' => '4 semaines',
                'programme' => "Semaine 1: Fondamentaux du management\nSemaine 2: Communication et leadership\nSemaine 3: Gestion d'équipes et motivation\nSemaine 4: Stratégie et prise de décision",
                'objectifs' => "• Développer les compétences managériales\n• Améliorer la communication interpersonnelle\n• Apprendre à motiver et fédérer une équipe\n• Maîtriser les outils de gestion de projet",
                'prerequis' => "• Expérience professionnelle de 2 ans minimum\n• Poste à responsabilité actuel ou futur\n• Motivation pour le développement personnel",
                'moyennes' => '14.8/20',
                'image' => 'formations/management.jpg',
                'document_pdf' => 'formations/programme-management.pdf'
            ],
            [
                'nom' => 'Formation Cybersécurité et Protection des Données',
                'lieu' => 'Campus Sécurité Numérique - Marseille',
                'duree' => '6 semaines',
                'programme' => "Module 1: Introduction à la cybersécurité\nModule 2: Analyse des vulnérabilités\nModule 3: Cryptographie et chiffrement\nModule 4: Sécurité des réseaux\nModule 5: Gestion des incidents\nModule 6: Conformité RGPD",
                'objectifs' => "• Comprendre les enjeux de la cybersécurité\n• Identifier et prévenir les menaces\n• Mettre en place des mesures de protection\n• Gérer les incidents de sécurité",
                'prerequis' => "• Connaissances en informatique et réseaux\n• Expérience en administration système recommandée\n• Certifications techniques appréciées",
                'moyennes' => '15.2/20',
                'image' => 'formations/cybersecurity.jpg',
                'document_pdf' => 'formations/programme-cybersec.pdf'
            ],
            [
                'nom' => 'Formation Marketing Digital et E-commerce',
                'lieu' => 'École de Commerce Digital - Toulouse',
                'duree' => '5 semaines',
                'programme' => "Semaine 1: Stratégie marketing digital\nSemaine 2: SEO/SEA et référencement\nSemaine 3: Réseaux sociaux et content marketing\nSemaine 4: E-commerce et conversion\nSemaine 5: Analytics et ROI",
                'objectifs' => "• Maîtriser les outils du marketing digital\n• Développer une stratégie omnicanale\n• Optimiser les campagnes publicitaires\n• Analyser les performances et ROI",
                'prerequis' => "• Connaissances de base en marketing\n• Familiarité avec les outils informatiques\n• Créativité et esprit analytique",
                'moyennes' => '13.9/20',
                'image' => 'formations/digital-marketing.jpg',
                'document_pdf' => 'formations/programme-marketing.pdf'
            ],
            [
                'nom' => 'Formation Data Science et Intelligence Artificielle',
                'lieu' => 'Institut IA - Grenoble',
                'duree' => '12 semaines',
                'programme' => "Phase 1: Mathématiques et statistiques\nPhase 2: Python pour la data science\nPhase 3: Machine Learning\nPhase 4: Deep Learning et réseaux de neurones\nPhase 5: Big Data et outils cloud\nPhase 6: Projet final et présentation",
                'objectifs' => "• Maîtriser les concepts de la data science\n• Développer des modèles d'IA\n• Traiter et analyser de gros volumes de données\n• Présenter et communiquer les résultats",
                'prerequis' => "• Niveau Bac+3 scientifique minimum\n• Connaissances en mathématiques\n• Expérience en programmation recommandée\n• Projet professionnel en IA",
                'moyennes' => '17.3/20',
                'image' => 'formations/data-science.jpg',
                'document_pdf' => 'formations/programme-datascience.pdf'
            ]
        ];
        
        $formations = [];
          foreach ($formationsData as $index => $data) {
            // Dates variables pour chaque formation
            $dateDebut = $now->copy()->addDays(rand(10, 60));
            $dateFin = $dateDebut->copy()->addWeeks(rand(4, 12));
            $dateCreation = $now->copy()->subDays(rand(30, 180));
            
            $formations[] = [
                'nom' => $data['nom'],
                'dateDebut' => $dateDebut->toDateString(), // Format date seulement
                'dateFin' => $dateFin->toDateString(), // Format date seulement
                'lieu' => $data['lieu'],
                'nombre_ouvriers' => rand(8, 25),
                'nombre_encadrants' => rand(3, 8),
                'nombre_cadres' => rand(1, 5),
                'duree' => $data['duree'], // String comme défini dans les migrations
                'moyennes' => $data['moyennes'], // String comme défini dans les migrations
                'prerequis' => $data['prerequis'],
                'programme' => $data['programme'],
                'objectifs' => $data['objectifs'],
                'image' => $data['image'],
                'document_pdf' => $data['document_pdf'],
                'DatedeCreation' => $dateCreation->toDateString(), // Format date seulement
                'type_formation_id' => $typeFormations[array_rand($typeFormations)],
                'statut_formation_id' => $statutFormations[array_rand($statutFormations)],
                'domaine_id' => $domaines[array_rand($domaines)],
                'entreprise_id' => $entreprises[0] === null ? null : $entreprises[array_rand($entreprises)],
                'created_at' => $dateCreation,
                'updated_at' => $now
            ];
        }

        DB::table('formations')->insert($formations);
        
        $this->command->info('✅ ' . count($formations) . ' formations ont été créées avec succès !');
    }
}
