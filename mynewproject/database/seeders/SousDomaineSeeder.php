<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SousDomaine;
use App\Models\Domaine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SousDomaineSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les IDs des domaines existants
        $domaines = DB::table('domaines')->get(['id', 'nom']);
        
        // Tableau pour stocker les sous-domaines à créer
        $sousDomaines = [];
        
        // Sous-domaines pour Technologie
        $techDomaine = $domaines->where('nom', 'Technologie')->first();
        if ($techDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'TECH-DEV', 'description' => 'Développement logiciel', 'domaine_code' => $techDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TECH-WEB', 'description' => 'Développement web', 'domaine_code' => $techDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TECH-MOB', 'description' => 'Développement mobile', 'domaine_code' => $techDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TECH-IA', 'description' => 'Intelligence artificielle', 'domaine_code' => $techDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TECH-SEC', 'description' => 'Cybersécurité', 'domaine_code' => $techDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
        // Sous-domaines pour Finance
        $financeDomaine = $domaines->where('nom', 'Finance')->first();
        if ($financeDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'FIN-ANAL', 'description' => 'Analyse financière', 'domaine_code' => $financeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'FIN-GEST', 'description' => 'Gestion de portefeuille', 'domaine_code' => $financeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'FIN-RISK', 'description' => 'Gestion des risques', 'domaine_code' => $financeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
        // Sous-domaines pour Télécommunications
        $telecomDomaine = $domaines->where('nom', 'Télécommunications')->first();
        if ($telecomDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'TEL-RES', 'description' => 'Réseaux télécoms', 'domaine_code' => $telecomDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TEL-5G', 'description' => 'Technologies 5G', 'domaine_code' => $telecomDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
        // Sous-domaines pour Industrie
        $industrieDomaine = $domaines->where('nom', 'Industrie')->first();
        if ($industrieDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'IND-AUT', 'description' => 'Automatisation industrielle', 'domaine_code' => $industrieDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'IND-MAN', 'description' => 'Manufacturing', 'domaine_code' => $industrieDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
        // Sous-domaines pour Tourisme
        $tourismeDomaine = $domaines->where('nom', 'Tourisme')->first();
        if ($tourismeDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'TOUR-HOT', 'description' => 'Hôtellerie', 'domaine_code' => $tourismeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'TOUR-ECO', 'description' => 'Écotourisme', 'domaine_code' => $tourismeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
        
        // Sous-domaines pour Santé
        $santeDomaine = $domaines->where('nom', 'Santé')->first();
        if ($santeDomaine) {
            $sousDomaines = array_merge($sousDomaines, [
                ['code' => 'SANT-TEC', 'description' => 'Technologies médicales', 'domaine_code' => $santeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'SANT-PRV', 'description' => 'Médecine préventive', 'domaine_code' => $santeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
                ['code' => 'SANT-INF', 'description' => 'Informatique médicale', 'domaine_code' => $santeDomaine->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Insérer les sous-domaines en utilisant upsert pour éviter les duplications
        if (!empty($sousDomaines)) {
            DB::table('sous_domaines')->upsert($sousDomaines, ['code']);
        }
    }
}