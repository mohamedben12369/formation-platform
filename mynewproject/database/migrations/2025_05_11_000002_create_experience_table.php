<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('experience', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->string('lieu');
            $table->string('titre');
            $table->string('entreprise');
         
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('type_experience_id');
            $table->foreign('type_experience_id')->references('id')->on('type_experiences')->onDelete('cascade');
            $table->string('description');
            $table->timestamps();
        });
    }
public function down(): void {
        Schema::dropIfExists('experience');
    }
};
