<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('capitals', function (Blueprint $table) {
            $table->id('CapitalID');
            $table->unsignedBigInteger('EmployeeID');
            $table->date('AddDate');
            $table->decimal('Amount', 10, 2);

            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('capitals');
    }
};
