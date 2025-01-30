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
        Schema::create('bag_khoroos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bag or Khoroo name
            $table->foreignId('soum_district_id')->constrained('soum_districts')->onDelete('cascade'); // Foreign key to soum_districts
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
        Schema::dropIfExists('bag_khoroos');
    }
};
