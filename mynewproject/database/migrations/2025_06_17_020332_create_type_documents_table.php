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
        Schema::create('type_documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description')->nullable();
            $table->string('icone')->default('fas fa-file');
            $table->string('couleur')->default('primary');
            $table->boolean('obligatoire')->default(false);
            $table->string('formats_autorises')->default('pdf,doc,docx'); // formats séparés par virgule
            $table->integer('taille_max_mb')->default(5); // taille max en MB
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_documents');
    }
};
