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
            if (!Schema::hasColumn('users', 'pangkat')) {
                $table->string('pangkat')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('pangkat');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            
            if (Schema::hasColumn('users', 'pangkat')) {
                $columns[] = 'pangkat';
            }
            if (Schema::hasColumn('users', 'foto')) {
                $columns[] = 'foto';
            }
            if (Schema::hasColumn('users', 'phone')) {
                $columns[] = 'phone';
            }
            
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
