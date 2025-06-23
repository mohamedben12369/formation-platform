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
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('IF')->nullable(); // Identifiant Fiscal
            $table->string('RC')->nullable(); // Registre de Commerce
            $table->string('ICE')->nullable(); // Identifiant Commun de l'Entreprise
            $table->string('patente')->nullable();
            $table->date('date_creation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['IF', 'RC', 'ICE', 'patente', 'date_creation']);
        });
    }
};
