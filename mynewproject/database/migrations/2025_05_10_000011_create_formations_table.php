<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('lieu', 100);
            $table->string('modalite', 50);
            $table->integer('nombrePlaces');
            $table->double('prix');
            $table->string('duree', 50);
            $table->text('prerequis');
            $table->text('programme');
            $table->text('objectifs');
            $table->date('DatedeCreation');
            $table->unsignedBigInteger('type_formation_id');
            $table->unsignedBigInteger('statut_formation_id');
            $table->timestamps();

            $table->foreign('type_formation_id')->references('id')->on('type_formations')->onDelete('cascade');
            $table->foreign('statut_formation_id')->references('id')->on('statut_formations')->onDelete('cascade');
           
            
        });
    }

    public function down(): void {
        Schema::dropIfExists('formations');
    }
};
