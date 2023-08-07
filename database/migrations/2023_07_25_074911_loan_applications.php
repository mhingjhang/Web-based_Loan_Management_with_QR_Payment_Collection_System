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
            $table->string('Approval');
            $table->string('Status');
            $table->unsignedBigInteger('LoanID');
            $table->unsignedBigInteger('CreditInvestigatorID')->nullable();
            $table->unsignedBigInteger('CollectorID')->nullable();

            $table->foreign('LoanID')->references('LoanID')->on('loans')->onDelete('cascade');
            $table->foreign('CreditInvestigatorID')->references('CreditInvestigatorID')->on('credit_investigators')->onDelete('cascade');
            $table->foreign('CollectorID')->references('CollectorID')->on('collectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
};
