<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('email', 100)->unique();
            $table->string('Adresse', 255);
            $table->string('tel', 20);
            $table->string('fax', 20);
            $table->string('CNSS', 50);
        });
    }

    public function down(): void {
        Schema::dropIfExists('entreprises');
    }
};
