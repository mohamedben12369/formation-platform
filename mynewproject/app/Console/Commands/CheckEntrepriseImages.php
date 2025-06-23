<?php

namespace App\Console\Commands;

use App\Models\Entreprise;
use Illuminate\Console\Command;

class CheckEntrepriseImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entreprise:check-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifier l\'état des images des entreprises';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $entreprises = Entreprise::whereNotNull('image')->get();
        
        $this->info("Vérification des images des entreprises...");
        
        foreach ($entreprises as $entreprise) {
            $imagePath = storage_path('app/public/' . $entreprise->image);
            $status = file_exists($imagePath) ? '✓' : '✗';
            
            $this->line("{$status} Entreprise #{$entreprise->id} - {$entreprise->nom}");
            $this->line("   Image: {$entreprise->image}");
            $this->line("   Chemin: {$imagePath}");
            $this->line("   URL: " . asset('storage/' . $entreprise->image));
            $this->line("");
        }
        
        $this->info("Vérification terminée.");
        
        // Vérifier le lien symbolique
        $publicStoragePath = public_path('storage');
        if (is_link($publicStoragePath)) {
            $this->info("✓ Lien symbolique storage existe");
            $this->line("   Lien: {$publicStoragePath}");
            $this->line("   Cible: " . readlink($publicStoragePath));
        } else {
            $this->error("✗ Lien symbolique storage manquant");
            $this->line("Exécutez: php artisan storage:link");
        }
    }
}
