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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('ClientID');
            $table->string('FirstName');
            $table->string('MiddleName')->nullable();
            $table->string('LastName');
            $table->string('Gender', 15);
            $table->date('DateOfBirth');
            $table->string('ContactNumber', 15);
            $table->string('Email');
            $table->string('Street');
            $table->string('Barangay');
            $table->string('City_Municipality');
            $table->string('Province');
            $table->string('BorrowerPhoto')->nullable();
            $table->string('ValidIDPhoto')->nullable();
            $table->string('Status');
            $table->unsignedBigInteger('ClientBusinessID');
            $table->unsignedBigInteger('UserAccountID');

            $table->foreign('ClientBusinessID')->references('ClientBusinessID')->on('client_businesses')->onDelete('cascade');
            $table->foreign('UserAccountID')->references('UserAccountID')->on('user_accounts')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
