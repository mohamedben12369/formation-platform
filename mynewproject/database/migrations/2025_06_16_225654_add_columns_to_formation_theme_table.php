<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('formation_theme', function (Blueprint $table) {
            // Ajouter les colonnes manquantes pour la table de pivot
            $table->decimal('prix', 10, 2)->default(0)->after('theme_id');
            $table->integer('duree_heures')->default(0)->after('prix');
            $table->date('date_debut')->nullable()->after('duree_heures');
            $table->date('date_fin')->nullable()->after('date_debut');
            $table->timestamps();
            
            // Ajouter un index unique pour éviter les doublons
            $table->unique(['formation_id', 'theme_id'], 'formation_theme_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formation_theme', function (Blueprint $table) {
            // Supprimer l'index unique
            $table->dropUnique('formation_theme_unique');
            
            // Supprimer les colonnes ajoutées
            $table->dropColumn(['prix', 'duree_heures', 'date_debut', 'date_fin', 'created_at', 'updated_at']);
        });
    }
};
