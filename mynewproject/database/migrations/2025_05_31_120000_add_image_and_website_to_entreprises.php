<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('image')->nullable()->after('date_creation');
            $table->string('website')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['image', 'website']);
        });
    }
};
