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
        Schema::create('complaint_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('org_id');
            $table->integer('complaint_id');
            $table->integer('recieved_user_id');
            $table->integer('sent_user_id');
            $table->datetime('recieved_date');
            $table->datetime('sent_date');
            $table->text('desc');
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
        Schema::dropIfExists('complaint_steps');
    }
};
