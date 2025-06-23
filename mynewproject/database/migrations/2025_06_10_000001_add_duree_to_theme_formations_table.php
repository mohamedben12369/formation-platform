<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->integer('duree')->nullable()->after('prix')->comment('Durée en heures');
        });
    }

    public function down()
    {
        Schema::table('theme_formations', function (Blueprint $table) {
            $table->dropColumn('duree');
        });
    }
};
