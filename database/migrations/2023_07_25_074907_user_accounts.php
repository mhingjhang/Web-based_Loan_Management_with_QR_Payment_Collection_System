<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id('UserAccountID');
            $table->string('UserName');
            $table->string('Password');
            $table->string('ProfilePicture')->nullable();
            $table->string('Status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_accounts');
    }
};
