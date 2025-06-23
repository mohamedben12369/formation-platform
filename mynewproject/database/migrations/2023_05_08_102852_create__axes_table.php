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
        // Types de sous domaines = axes HARDSKILLS, SOFTSKILLS, etc.

        Schema::create('axes', function (Blueprint $table) {
            $table->id(); // clé primaire
            $table->string('nom')->unique(); // nom unique
            $table->text('description')->nullable(); // description optionnelle
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('axes');
    }
};
