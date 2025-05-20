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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('national_id')->after('name')->nullable();
            $table->string('economic_code');
            $table->string('registration_number');
            $table->string('fax')->nullable();
            $table->string('office_phone');
            $table->string('zipcode');
            $table->string('address');
            $table->foreignId('city_id')->nullable()->constrained('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
