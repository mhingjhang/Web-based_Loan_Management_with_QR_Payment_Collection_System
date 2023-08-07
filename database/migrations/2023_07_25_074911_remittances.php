<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('remittances', function (Blueprint $table) {
            $table->id('RemittanceID');
            $table->unsignedBigInteger('CollectorID');
            $table->datetime('RemittanceDate');
            $table->decimal('RemittanceAmount', 10, 2);

            $table->foreign('CollectorID')->references('CollectorID')->on('collectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('remittances');
    }
};

