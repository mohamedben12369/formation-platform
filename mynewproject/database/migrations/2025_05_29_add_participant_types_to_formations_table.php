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
            // Supprimer le champ nombrePlaces
            $table->dropColumn('nombrePlaces');
            
            // Ajouter les trois nouveaux champs
            $table->integer('nombre_ouvriers')->default(0)->after('modalite');
            $table->integer('nombre_encadrants')->default(0)->after('nombre_ouvriers');
            $table->integer('nombre_cadres')->default(0)->after('nombre_encadrants');
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
            // Supprimer les trois nouveaux champs
            $table->dropColumn(['nombre_ouvriers', 'nombre_encadrants', 'nombre_cadres']);
            
            // Rétablir le champ nombrePlaces
            $table->integer('nombrePlaces')->after('modalite');
        });
    }
};
