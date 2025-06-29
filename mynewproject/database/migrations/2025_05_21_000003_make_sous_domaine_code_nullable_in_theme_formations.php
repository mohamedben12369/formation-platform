<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->string('sous_domaine_code', 10)->nullable()->change();
        });
    }
    public function down(): void {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->string('sous_domaine_code', 10)->nullable(false)->change();
        });
    }
};
