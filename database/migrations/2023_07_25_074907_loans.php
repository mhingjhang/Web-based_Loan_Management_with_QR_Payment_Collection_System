<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('LoanID');
            $table->decimal('Principal', 10, 2);
            $table->integer('DurationDays');
            $table->integer('DurationMonths');
            $table->decimal('Interest', 10, 2);
            $table->decimal('InterestRate', 5, 2);
            $table->decimal('TotalAmountDue', 10, 2);
            $table->decimal('DailyRepayment', 10, 2);
            $table->decimal('ServiceFee', 10, 2);
            $table->decimal('Disbursement', 10, 2)->nullable();
            $table->date('DisbursementDate')->nullable();
            $table->date('EffectiveDate')->nullable();
            $table->date('MaturityDate')->nullable();
            $table->string('Status');
            $table->unsignedBigInteger('BorrowerID');

            $table->foreign('BorrowerID')->references('BorrowerID')->on('borrowers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
