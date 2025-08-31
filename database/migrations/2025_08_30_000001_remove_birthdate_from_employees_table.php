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
        if (Schema::hasTable('employees') && Schema::hasColumn('employees', 'birthdate')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('birthdate');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('employees') && !Schema::hasColumn('employees', 'birthdate')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->date('birthdate')->nullable()->after('last_name');
            });
        }
    }
};
