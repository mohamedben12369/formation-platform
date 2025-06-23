<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->unsignedBigInteger('domaine_id')->after('statut_formation_id');
            $table->foreign('domaine_id')
                  ->references('id')
                  ->on('domaines')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropForeign(['domaine_id']);
            $table->dropColumn('domaine_id');
        });
    }
};
