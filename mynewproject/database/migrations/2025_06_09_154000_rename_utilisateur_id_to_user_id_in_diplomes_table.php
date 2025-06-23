<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diplomes', function (Blueprint $table) {
            $table->renameColumn('utilisateur_id', 'user_id');
        });
    }

    public function down(): void
    {
        Schema::table('diplomes', function (Blueprint $table) {
            $table->renameColumn('user_id', 'utilisateur_id');
        });
    }
};
