<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Formation;
use App\Models\ThemeFormation;

class SyncFormationThemes extends Command
{
    protected $signature = 'formations:sync-themes';
    protected $description = 'Synchronise les données de prix et durée dans la table pivot formation_theme';

    public function handle()
    {
        $this->info('Synchronisation des données formation_theme...');

        $formations = Formation::with('themes')->get();
        $totalSynced = 0;

        foreach ($formations as $formation) {
            foreach ($formation->themes as $theme) {
                // Mettre à jour les données du pivot avec les valeurs du thème
                $formation->themes()->updateExistingPivot($theme->idtheme, [
                    'prix' => $theme->prix ?? 0,
                    'duree_heures' => $theme->duree ?? 0,
                    'date_debut' => $formation->dateDebut,
                    'date_fin' => $formation->dateFin,
                    'updated_at' => now()
                ]);
                
                $totalSynced++;
            }
        }

        $this->info("Synchronisation terminée ! {$totalSynced} relations mises à jour.");
        
        // Afficher un résumé
        $this->table(
            ['Formation', 'Prix Total', 'Durée Totale'],
            $formations->map(function($formation) {
                return [
                    $formation->nom,
                    number_format($formation->fresh()->prix_total, 2) . ' DH',
                    $formation->fresh()->duree_totale . ' h'
                ];
            })
        );

        return 0;
    }
}
