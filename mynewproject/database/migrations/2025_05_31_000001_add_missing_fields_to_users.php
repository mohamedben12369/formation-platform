<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }
            if (!Schema::hasColumn('users', 'background_image')) {
                $table->string('background_image')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
            if (!Schema::hasColumn('users', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_image',
                'background_image',
                'is_active',
                'remember_token',
            ]);
            // Ne pas supprimer created_at et updated_at car ils peuvent être utilisés par d'autres fonctionnalités
        });
    }
};
