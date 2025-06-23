<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('competences', function (Blueprint $table) {
            $table->unsignedBigInteger('utilisateur_id')->nullable();
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::table('competences', function (Blueprint $table) {
            $table->dropForeign(['utilisateur_id']);
            $table->dropColumn('utilisateur_id');
        });
    }
};
