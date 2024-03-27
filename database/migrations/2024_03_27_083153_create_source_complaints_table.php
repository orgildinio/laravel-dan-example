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
        Schema::create('source_complaints', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_date');
            $table->string('source');
            $table->string('quarter');
            $table->string('assigned_at');
            $table->string('number');
            $table->string('city');
            $table->string('register_no');
            $table->string('phone');
            $table->text('content');
            $table->string('email')->nullable();
            $table->string('type');
            $table->string('address');
            $table->string('district');
            $table->string('fullname');
            $table->string('path');
            $table->integer('complaint_id')->nullable();
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
        Schema::dropIfExists('source_complaints');
    }
};
