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
        Schema::table('users', function (Blueprint $table) {
            $table->string('danFirstname')->nullable();
            $table->string('danLastname')->nullable();
            $table->string('danRegnum')->nullable();
            $table->string('danAimagCityName')->nullable();
            $table->string('danSoumDistrictName')->nullable();
            $table->string('danBagKhorooName')->nullable();
            $table->text('danPassportAddress')->nullable();
            $table->string('danGender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
