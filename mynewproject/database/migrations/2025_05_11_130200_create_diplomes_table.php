<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('etablissement_id');
            $table->unsignedBigInteger('type_diplome_id');
            $table->string('nom', 255);
            $table->date('date_obtention');
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
            $table->foreign('type_diplome_id')->references('id')->on('type_diplomes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('diplomes');
    }
};
