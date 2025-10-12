<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role');
            $table->string('university')->nullable();
            $table->string('nim')->nullable();
            $table->string('ktm_path')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('industry')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('no_hp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'university', 'nim', 'ktm_path', 'company_name', 
                'company_address', 'industry', 'website', 'logo_path', 'no_hp'
            ]);
        });
    }
};