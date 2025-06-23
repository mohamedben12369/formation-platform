<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domaines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('sous_domaines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('description', 255)->nullable();
            $table->unsignedBigInteger('domaine_code');
            $table->foreign('domaine_code')->references('id')->on('domaines')->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('axes_id');

            $table->foreign('axes_id')
                ->references('id')
                ->on('axes')
                ->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('sous_domaines');
        Schema::dropIfExists('domaines');
    }
};
