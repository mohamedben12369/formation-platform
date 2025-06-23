<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('statut_formations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->date('dateCreation');
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('statut_formations');
    }
};
