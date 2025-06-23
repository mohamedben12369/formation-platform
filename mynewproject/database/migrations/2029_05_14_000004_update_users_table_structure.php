<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only drop name column since we want to keep email
        $columnsToDrop = ['name']; // Only drop name

        foreach ($columnsToDrop as $column) {
            if (Schema::hasColumn('users', $column)) {
                Schema::table('users', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }

        // Ensure email column exists and is unique
        if (!Schema::hasColumn('users', 'email')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->unique();
            });
        }

        // Modify or add date_de_naissance
        if (!Schema::hasColumn('users', 'date_de_naissance')) {
            Schema::table('users', function (Blueprint $table) {
                $table->date('date_de_naissance')->after('tel');
            });
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->date('date_de_naissance')->nullable(false)->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'date_de_naissance')) {
                $table->date('date_de_naissance')->nullable()->change();
            }

            // Add name column back if needed
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable();
            }
        });
    }
};
