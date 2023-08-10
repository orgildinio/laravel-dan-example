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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('registerNumber');
            $table->string('phone');
            $table->string('country');
            $table->string('district');
            $table->string('khoroo');
            $table->string('addressDetail');
            $table->text('complaint');
            $table->integer('file_id');
            $table->integer('category_id');
            $table->integer('status_id');
            $table->integer('channel_id');
            $table->integer('organization_id');
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
        Schema::dropIfExists('complaints');
    }
};
