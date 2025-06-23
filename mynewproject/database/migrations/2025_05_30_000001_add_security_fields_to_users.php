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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'securite_question_id')) {
                $table->unsignedBigInteger('securite_question_id')->nullable();
                $table->foreign('securite_question_id')->references('id')->on('securite_question')->onDelete('set null');
            }
            if (!Schema::hasColumn('users', 'reponse')) {
                $table->string('reponse')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'securite_question_id')) {
                $table->dropForeign(['securite_question_id']);
            }
        });
    }
};
