<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dan_users', function (Blueprint $table) {
            $table->id();
            $table->string('personId');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('regnum');
            $table->string('aimagCityName');
            $table->string('soumDistrictName');
            $table->string('bagKhorooName');
            $table->text('passportAddress');
            $table->string('image');
            $table->string('gender');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dan_users');
    }
};
