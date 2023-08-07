<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id('BusinessID'); // Assuming 'id' is the primary key of the businesses table and it's of type unsignedBigInteger
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

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};
