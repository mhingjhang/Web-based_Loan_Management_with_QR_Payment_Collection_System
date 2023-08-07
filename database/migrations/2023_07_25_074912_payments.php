<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('PaymentID');
            $table->unsignedBigInteger('BorrowerID');
            $table->unsignedBigInteger('EmployeeID');
            $table->unsignedBigInteger('CollectorID');
            $table->date('PaymentDate');
            $table->decimal('PaymentAmount', 10, 2);
             $table->string('PaymentMethod');
            $table->string('Void');

            $table->foreign('BorrowerID')->references('BorrowerID')->on('borrowers')->onDelete('cascade');
            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');
            $table->foreign('CollectorID')->references('CollectorID')->on('collectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
