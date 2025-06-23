<?php

// Test simple pour vérifier la création de formation
require_once 'vendor/autoload.php';

use App\Models\Formation;
use App\Models\TypeFormation;
use App\Models\StatutFormation;

// Bootloader Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Test de création d'une formation...\n";
    
    // Vérifier les types et statuts disponibles
    $types = TypeFormation::all();
    $statuts = StatutFormation::all();
    
    echo "Types disponibles: " . $types->count() . "\n";
    echo "Statuts disponibles: " . $statuts->count() . "\n";
    
    if ($types->count() > 0 && $statuts->count() > 0) {        $formation = Formation::create([
            'nom' => 'Formation Test',
            'dateDebut' => '2025-06-20',
            'dateFin' => '2025-06-25',
            'lieu' => 'Casablanca',
            'nombre_ouvriers' => 10,
            'nombre_encadrants' => 5,
            'nombre_cadres' => 2,
            'duree' => 40, // Ajouter la durée
            'prerequis' => 'Aucun prérequis', // Ajouter les prérequis
            'programme' => 'Programme de test',
            'objectifs' => 'Objectifs de test',
            'moyennes' => 'Test',
            'type_formation_id' => $types->first()->id,
            'statut_formation_id' => $statuts->first()->id,
            'DatedeCreation' => now(),
        ]);
        
        echo "Formation créée avec succès! ID: " . $formation->id . "\n";
    } else {
        echo "Pas de types ou statuts disponibles\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
