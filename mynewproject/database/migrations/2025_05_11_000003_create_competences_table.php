<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        Schema::create( 'niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create( 'competences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveaux')->onDelete('cascade');
            $table->unsignedBigInteger('sous_domaines_id');
            $table->foreign('sous_domaines_id')->references('id')->on('sous_domaines')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down(): void {
        Schema::dropIfExists('niveaux');
        Schema::dropIfExists('competences');


    }
};
