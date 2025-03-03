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
        Schema::create('org_user_data', function (Blueprint $table) {
            $table->id();
            $table->string('usercode')->unique();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('regnum')->unique();
            $table->string('phone');
            $table->string('aimagCityName');
            $table->string('sumDistrictName');
            $table->string('bagKhorooName');
            $table->string('buildingStreet');
            $table->string('door');
            $table->string('mail')->nullable();
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
        Schema::dropIfExists('org_user_data');
    }
};
