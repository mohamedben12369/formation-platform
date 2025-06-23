<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('prenom');
                $table->string('email')->unique();
                $table->string('tel', 20);
                $table->date('date_de_naissance');
                $table->foreignId('role_id')->constrained('roles');
                $table->string('reponse');
                $table->boolean('is_active')->default(true);
                $table->string('password');
                $table->unsignedBigInteger('securite_question_id')->nullable();
                $table->foreign('securite_question_id')
                      ->references('id')
                      ->on('securite_question')
                      ->onDelete('set null');
                $table->rememberToken();
                $table->string('profile_image')->nullable();
                $table->string('background_image')->nullable();
                $table->timestamps();
            });
        } else {
            // S'assurer que tous les champs existent
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'id')) {
                    $table->id();
                }
                if (!Schema::hasColumn('users', 'nom')) {
                    $table->string('nom');
                }
                if (!Schema::hasColumn('users', 'prenom')) {
                    $table->string('prenom');
                }
                if (!Schema::hasColumn('users', 'email')) {
                    $table->string('email')->unique();
                }
                if (!Schema::hasColumn('users', 'tel')) {
                    $table->string('tel', 20);
                }
                if (!Schema::hasColumn('users', 'date_de_naissance')) {
                    $table->date('date_de_naissance');
                }
                if (!Schema::hasColumn('users', 'role_id')) {
                    $table->foreignId('role_id')->constrained('roles');
                }
                if (!Schema::hasColumn('users', 'reponse')) {
                    $table->string('reponse');
                }
                if (!Schema::hasColumn('users', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
                if (!Schema::hasColumn('users', 'password')) {
                    $table->string('password');
                }
                if (!Schema::hasColumn('users', 'securite_question_id')) {
                    $table->foreignId('securite_question_id')->constrained('securite_questions')->onDelete('set null')->nullable();
                }
                if (!Schema::hasColumn('users', 'remember_token')) {
                    $table->rememberToken();
                }
                if (!Schema::hasColumn('users', 'profile_image')) {
                    $table->string('profile_image')->nullable();
                }
                if (!Schema::hasColumn('users', 'background_image')) {
                    $table->string('background_image')->nullable();
                }
                if (!Schema::hasColumn('users', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
