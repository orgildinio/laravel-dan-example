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
        Schema::create('cdr', function (Blueprint $table) {
            $table->timestamp('calldate');
            $table->string('clid', 80);
            $table->string('src', 80);
            $table->string('dst', 80);
            $table->string('dcontext', 80);
            $table->string('channel', 80);
            $table->string('dstchannel', 80);
            $table->string('lastapp', 80);
            $table->string('lastdata', 80);
            $table->integer('duration');
            $table->integer('billsec');
            $table->string('disposition', 45);
            $table->integer('amaflags');
            $table->string('accountcode', 20);
            $table->string('uniqueid', 150);
            $table->string('userfield', 255);
            $table->string('peeraccount', 20);
            $table->string('linkedid', 150);
            $table->integer('sequence');
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
        Schema::dropIfExists('cdrs');
    }
};
