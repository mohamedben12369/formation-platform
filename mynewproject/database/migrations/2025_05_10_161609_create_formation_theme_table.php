<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('formation_theme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formation_id');
            $table->unsignedBigInteger('theme_id');
            
            // Colonnes additionnelles pour la table de pivot
            $table->decimal('prix', 10, 2)->default(0);
            $table->integer('duree_heures')->default(0);
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();

            // Clés étrangères
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->foreign('theme_id')->references('idtheme')->on('theme_formations')->onDelete('cascade');
            
            // Index unique pour éviter les doublons
            $table->unique(['formation_id', 'theme_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('formation_theme');
    }
};
