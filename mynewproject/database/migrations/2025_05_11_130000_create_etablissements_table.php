<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('ville', 100);
            $table->string('pays', 100);
            $table->string('telephone', 10);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('etablissements');
    }
};
