<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formations', function (Blueprint $table) {
            // Vérifier et supprimer les colonnes modalite et prix
            if (Schema::hasColumn('formations', 'modalite')) {
                $table->dropColumn('modalite');
            }
            if (Schema::hasColumn('formations', 'prix')) {
                $table->dropColumn('prix');
            }
            
            // Vérifier et ajouter les colonnes pour les types de participants si elles n'existent pas
            if (!Schema::hasColumn('formations', 'nombre_ouvriers')) {
                $table->integer('nombre_ouvriers')->default(0);
            }
            if (!Schema::hasColumn('formations', 'nombre_encadrants')) {
                $table->integer('nombre_encadrants')->default(0);
            }
            if (!Schema::hasColumn('formations', 'nombre_cadres')) {
                $table->integer('nombre_cadres')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formations', function (Blueprint $table) {
            // Restaurer les colonnes supprimées
            if (!Schema::hasColumn('formations', 'modalite')) {
                $table->string('modalite')->nullable();
            }
            if (!Schema::hasColumn('formations', 'prix')) {
                $table->decimal('prix', 10, 2)->nullable();
            }
            
            // Note: Nous ne supprimons pas les colonnes de types de participants dans le rollback
            // car elles sont gérées par une autre migration
        });
    }
};
