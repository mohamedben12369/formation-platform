<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('securite_question', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('securite_question');
    }
};
