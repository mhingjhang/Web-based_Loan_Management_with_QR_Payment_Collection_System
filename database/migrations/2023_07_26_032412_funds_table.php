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
        Schema::create('funds', function (Blueprint $table) {
            $table->id('FundID');
            $table->date('TransactionDate');
            $table->decimal('Amount', 10, 2);
            $table->string('TransactionType');
            $table->unsignedBigInteger('EmployeeID');
            $table->unsignedBigInteger('LoanID')->nullable();
            $table->unsignedBigInteger('RemittanceID')->nullable();

            $table->foreign('EmployeeID')->references('EmployeeID')->on('employees')->onDelete('cascade');
            $table->foreign('LoanID')->references('LoanID')->on('loans')->onDelete('cascade');
            $table->foreign('RemittanceID')->references('RemittanceID')->on('remittances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
