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
        Schema::table('users', function (Blueprint $table) {
            // Vérifier si les colonnes existent avant de les supprimer
            if (Schema::hasColumn('users', 'telephone')) {
                $table->dropColumn('telephone');
            }
            
            if (Schema::hasColumn('users', 'date_naissance')) {
                $table->dropColumn('date_naissance');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restaurer les colonnes si elles n'existent pas
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'date_naissance')) {
                $table->date('date_naissance')->nullable();
            }
        });
    }
};
