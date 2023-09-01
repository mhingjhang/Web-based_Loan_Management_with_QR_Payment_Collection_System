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
            $table->date('PaymentDate');
            $table->decimal('PaymentAmount', 10, 2);
            $table->decimal('PrincipalEarned', 10, 2);
            $table->decimal('InterestEarned', 10, 2);
            $table->string('PaymentMethod');
            $table->string('Void');
            $table->boolean('isPaid');
            $table->unsignedBigInteger('LoanID');
            $table->unsignedBigInteger('EmployeeID');

            $table->foreign('LoanID')->references('LoanID')->on('loans')->onDelete('cascade');
            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
