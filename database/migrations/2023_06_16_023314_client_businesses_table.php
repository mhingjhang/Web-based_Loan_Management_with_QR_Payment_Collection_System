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
        Schema::create('client_businesses', function (Blueprint $table) {
            $table->id("ClientBusinessID");
            $table->string('BusinessName');
            $table->decimal('AverageDailyIncome', 10, 2);
            $table->string('TypeOfBusiness');
            $table->string('Street');
            $table->string('Barangay');
            $table->string('City_Municipality');
            $table->string('Province');
            $table->string('EstablishmentPhoto')->nullable();
            $table->string('BusinessPermitPhoto')->nullable();
            $table->string('Status');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_businesses');
    }
};
