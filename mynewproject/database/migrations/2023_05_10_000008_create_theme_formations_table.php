<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('theme_formations', function (Blueprint $table) {
            $table->id('idtheme');
            $table->string('titre', 255);
            $table->string('sous_domaine_code', 10);
            $table->foreign('sous_domaine_code')->references('code')->on('sous_domaines')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('theme_formations');
    }
};
