<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Formation;
use App\Models\ThemeFormation;
use Illuminate\Support\Facades\DB;

class SyncFormationThemeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'formation:sync-theme-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise les données prix et durée des thèmes dans la table pivot formation_theme';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Début de la synchronisation des données formation_theme...');

        // Récupérer toutes les entrées de la table pivot
        $pivotEntries = DB::table('formation_theme')->get();

        $updated = 0;
        $errors = 0;

        foreach ($pivotEntries as $entry) {
            try {
                // Récupérer les données du thème
                $theme = ThemeFormation::find($entry->theme_id);
                
                if ($theme) {
                    // Mettre à jour l'entrée pivot avec les données du thème
                    DB::table('formation_theme')
                        ->where('formation_id', $entry->formation_id)
                        ->where('theme_id', $entry->theme_id)
                        ->update([
                            'prix' => $theme->prix ?? 0,
                            'duree_heures' => $theme->duree ?? 0,
                            'updated_at' => now()
                        ]);
                    
                    $updated++;
                    $this->line("✓ Formation {$entry->formation_id} - Thème {$entry->theme_id}: Prix={$theme->prix}, Durée={$theme->duree}h");
                } else {
                    $this->warn("⚠ Thème {$entry->theme_id} introuvable");
                    $errors++;
                }
            } catch (\Exception $e) {
                $this->error("✗ Erreur pour Formation {$entry->formation_id} - Thème {$entry->theme_id}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->info("Synchronisation terminée !");
        $this->info("✓ {$updated} entrées mises à jour");
        if ($errors > 0) {
            $this->warn("⚠ {$errors} erreurs rencontrées");
        }

        // Afficher un résumé des formations
        $this->info("\nRésumé des formations :");
        $formations = Formation::with('themes')->get();
        
        foreach ($formations as $formation) {
            $prixTotal = $formation->prix_total;
            $dureeTotal = $formation->duree_totale;
            $this->line("Formation '{$formation->nom}': Prix total = {$prixTotal} DH, Durée totale = {$dureeTotal}h");
        }

        return Command::SUCCESS;
    }
}
