<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('remittances', function (Blueprint $table) {
            $table->id('RemittanceID');
            $table->datetime('RemittanceDate');
            $table->decimal('RemittanceAmount', 10, 2);
            $table->unsignedBigInteger('EmployeeID');

            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('remittances');
    }
};

