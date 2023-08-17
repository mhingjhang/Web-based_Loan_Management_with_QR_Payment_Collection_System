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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('ApprovalID');
            $table->unsignedBigInteger('ApprovalLevelID');
            $table->unsignedBigInteger('LoanApplicationID');
            $table->timestamps();

            $table->foreign('ApprovalLevelID')->references('ApprovalLevelID')->on('approval_levels')->onDelete('cascade');
            $table->foreign('LoanApplicationID')->references('LoanApplicationID')->on('loan_applications')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
