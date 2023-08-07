<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('collectors', function (Blueprint $table) {
            $table->id('CollectorID');
            $table->unsignedBigInteger('UserAccountID');
            $table->string('FirstName');
            $table->string('MiddleName')->nullable();
            $table->string('LastName');
            $table->string('Email');
            $table->string('ContactNumber', 15);
            $table->string('CollectionArea');
            $table->string('Status');

            $table->foreign('UserAccountID')->references('UserAccountID')->on('user_accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('collectors');
    }
};
