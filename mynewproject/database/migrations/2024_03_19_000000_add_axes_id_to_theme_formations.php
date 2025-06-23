<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->unsignedBigInteger('axes_id')->after('sous_domaine_code');
            $table->foreign('axes_id')->references('id')->on('axes')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->dropForeign(['axes_id']);
            $table->dropColumn('axes_id');
        });
    }
}; 