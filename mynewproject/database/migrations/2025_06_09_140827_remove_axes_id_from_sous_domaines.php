<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sous_domaines', function (Blueprint $table) {
            $table->dropForeign(['axes_id']);
            $table->dropColumn('axes_id');
        });
    }

    public function down(): void
    {
        Schema::table('sous_domaines', function (Blueprint $table) {
            $table->unsignedBigInteger('axes_id')->nullable();
            $table->foreign('axes_id')
                ->references('id')
                ->on('axes')
                ->onDelete('set null');
        });
    }
};
