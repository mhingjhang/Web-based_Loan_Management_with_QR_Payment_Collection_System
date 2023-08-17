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
        Schema::create('restructure_loans', function (Blueprint $table) {
            $table->id('RestructureID');
            $table->date('RestructureDate');
            $table->date('MaturityDate');
            $table->decimal('Balance', 10, 2);
            $table->decimal('PenaltyAmount', 10, 2);
            $table->decimal('TotalRestructureAmount', 10, 2);
            $table->decimal('DailyRepayment', 10, 2);
            $table->unsignedBigInteger('LoanID');

            $table->foreign('LoanID')->references('LoanID')->on('loans')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restructure_loans');
    }
};
