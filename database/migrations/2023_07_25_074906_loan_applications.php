<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id('LoanApplicationID');
            $table->date('ApplicationDate');
            $table->decimal('Principal', 10, 2);
            $table->integer('DurationDays');
            $table->integer('DurationMonths');
            $table->decimal('Interest', 10, 2);
            $table->decimal('InterestRate', 5, 2);
            $table->decimal('TotalAmountDue', 10, 2);
            $table->decimal('DailyRepayment', 10, 2);
            $table->decimal('ServiceFee', 10, 2);
            $table->string('Status');
            $table->unsignedBigInteger('ClientID');
            $table->unsignedBigInteger('EmployeeID');

            $table->foreign('ClientID')->references('ClientID')->on('clients')->onDelete('cascade');
            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
};
