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
        Schema::create('cel', function (Blueprint $table) {
            $table->id();
            $table->string('eventtype', 30);
            $table->timestamp('eventtime');
            $table->string('userdeftype', 255);
            $table->string('cid_name', 80);
            $table->string('cid_num', 80);
            $table->string('cid_ani', 80);
            $table->string('cid_rdnis', 80);
            $table->string('cid_dnid', 80);
            $table->string('exten', 80);
            $table->string('context', 80);
            $table->string('channame', 80);
            $table->string('appname', 80);
            $table->string('appdata', 80);
            $table->integer('amaflags');
            $table->string('accountcode', 20);
            $table->string('peeraccount', 20);
            $table->string('uniqueid', 150);
            $table->string('linkedid', 150);
            $table->string('userfield', 255);
            $table->string('peer', 80);
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
        Schema::dropIfExists('cel');
    }
};
