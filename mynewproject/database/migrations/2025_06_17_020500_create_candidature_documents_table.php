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
        Schema::create('candidature_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained('candidatures')->onDelete('cascade');
            $table->foreignId('type_document_id')->constrained('type_documents')->onDelete('cascade');
            $table->string('nom_fichier');
            $table->string('nom_original');
            $table->string('chemin_fichier');
            $table->string('extension');
            $table->integer('taille_ko');
            $table->timestamps();
            
            $table->unique(['candidature_id', 'type_document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidature_documents');
    }
};
