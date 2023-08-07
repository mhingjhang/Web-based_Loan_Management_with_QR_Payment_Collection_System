<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('EmployeeID');
            $table->unsignedBigInteger('UserAccountID');
            $table->string('FirstName');
            $table->string('MiddleName')->nullable();
            $table->string('LastName');
            $table->string('Email');
            $table->string('ContactNumber', 15);
            $table->string('Position');
            $table->string('Status');

            $table->foreign('UserAccountID')->references('UserAccountID')->on('user_accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
