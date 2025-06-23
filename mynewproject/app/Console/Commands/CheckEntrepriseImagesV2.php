<?php

namespace App\Console\Commands;

use App\Models\Entreprise;
use Illuminate\Console\Command;

class CheckEntrepriseImagesV2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entreprise:check-images-v2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifier l\'état des images des entreprises (Version 2)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Vérification des images des entreprises ===');
        
        // Vérifier le lien symbolique
        $publicStoragePath = public_path('storage');
        $this->info("Chemin storage public: {$publicStoragePath}");
        
        if (file_exists($publicStoragePath)) {
            if (is_link($publicStoragePath)) {
                $this->info("✓ Lien symbolique storage existe");
                $this->line("   Lien: {$publicStoragePath}");
                $this->line("   Cible: " . readlink($publicStoragePath));
            } else {
                $this->info("✓ Dossier storage existe (pas un lien symbolique)");
            }
        } else {
            $this->error("✗ Lien symbolique storage manquant");
            $this->line("Exécutez: php artisan storage:link");
            return 1;
        }
        
        $this->line('');
        
        // Récupérer toutes les entreprises avec images
        $entreprises = Entreprise::whereNotNull('image')->get();
        
        if ($entreprises->isEmpty()) {
            $this->info("Aucune entreprise avec image trouvée.");
            return 0;
        }
        
        $this->info("Vérification de {$entreprises->count()} entreprise(s) avec image...");
        $this->line('');
        
        foreach ($entreprises as $entreprise) {
            $imagePath = storage_path('app/public/' . $entreprise->image);
            $publicPath = public_path('storage/' . $entreprise->image);
            $storageExists = file_exists($imagePath);
            $publicExists = file_exists($publicPath);
            
            $this->line("Entreprise #{$entreprise->id}: {$entreprise->nom}");
            $this->line("  Image BDD: {$entreprise->image}");
            $this->line("  Chemin storage: {$imagePath}");
            $this->line("  Chemin public: {$publicPath}");
            $this->line("  Existe storage: " . ($storageExists ? '✓' : '✗'));
            $this->line("  Existe public: " . ($publicExists ? '✓' : '✗'));
            $this->line("  URL: " . asset('storage/' . $entreprise->image));
            
            if ($storageExists && $publicExists) {
                $this->info("  ✓ OK - Image accessible");
            } elseif ($storageExists && !$publicExists) {
                $this->warn("  ⚠ Problème de lien symbolique");
            } elseif (!$storageExists) {
                $this->error("  ✗ Fichier manquant");
            }
            
            $this->line('');
        }
        
        $this->info('Vérification terminée.');
        return 0;
    }
}
