<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les codes des sous-domaines existants
        $sousDomaineCodes = DB::table('sous_domaines')->pluck('code')->toArray();
        if (empty($sousDomaineCodes)) {
            // Créer un sous-domaine par défaut si aucun n'existe
            $sousDomaineCodes = ['SD001'];
            DB::table('sous_domaines')->insert([
                'code' => 'SD001',
                'description' => 'Sous-domaine par défaut',
                'domaine_id' => 1
            ]);
        }
        
        // Récupérer les IDs des axes existants
        $axesIds = DB::table('axes')->pluck('id')->toArray();
        if (empty($axesIds)) {
            // Créer un axe par défaut si aucun n'existe
            $axesIds = [1];
            DB::table('axes')->insert([
                'id' => 1,
                'nom' => 'Axe par défaut',
                'description' => 'Axe par défaut pour les thèmes'
            ]);
        }
        
        $themes = [
            [
                'titre' => 'Développement Web Frontend',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1500.00,
                'prerequis' => 'Connaissances de base en HTML et CSS',
                'competence_visees' => 'Maîtrise des frameworks frontend (React, Vue, Angular)'
            ],
            [
                'titre' => 'Développement Web Backend',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1600.00,
                'prerequis' => 'Connaissances de base en programmation',
                'competence_visees' => 'Développement d\'APIs RESTful, gestion de bases de données'
            ],
            [
                'titre' => 'Intelligence Artificielle',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 2000.00,
                'prerequis' => 'Bases en mathématiques et programmation Python',
                'competence_visees' => 'Comprendre et implémenter des algorithmes d\'IA, machine learning et deep learning'
            ],
            [
                'titre' => 'Cybersécurité',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1800.00,
                'prerequis' => 'Connaissances en réseaux et systèmes',
                'competence_visees' => 'Identifier et corriger les vulnérabilités, mettre en place des protections'
            ],
            [
                'titre' => 'Gestion de Projet Agile',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1200.00,
                'prerequis' => 'Expérience professionnelle de base',
                'competence_visees' => 'Planification, suivi et gestion efficace de projets avec méthodologies agiles (Scrum, Kanban)'
            ],
            [
                'titre' => 'Cloud Computing',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1700.00,
                'prerequis' => 'Connaissances en administration système',
                'competence_visees' => 'Déploiement et gestion d\'infrastructures cloud, services AWS/Azure/GCP'
            ],
            [
                'titre' => 'DevOps',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1900.00,
                'prerequis' => 'Connaissances en développement et opérations',
                'competence_visees' => 'Intégration continue, déploiement continu, automatisation'
            ],
            [
                'titre' => 'Analyse de Données',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1600.00,
                'prerequis' => 'Bases en statistiques',
                'competence_visees' => 'Collecte, nettoyage, analyse et visualisation de données'
            ],
            [
                'titre' => 'Développement Mobile',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1750.00,
                'prerequis' => 'Connaissances en programmation orientée objet',
                'competence_visees' => 'Développement d\'applications mobiles natives et cross-platform'
            ],
            [
                'titre' => 'Bases de Données',
                'sous_domaine_code' => $sousDomaineCodes[array_rand($sousDomaineCodes)],
                'axes_id' => $axesIds[array_rand($axesIds)],
                'prix' => 1400.00,
                'prerequis' => 'Connaissances de base en informatique',
                'competence_visees' => 'Conception, optimisation et administration de bases de données SQL et NoSQL'
            ],
        ];

        DB::table('theme_formations')->insert($themes);
    }
}