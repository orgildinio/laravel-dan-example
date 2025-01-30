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
        Schema::table('complaints', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('cdr_id');
            $table->unsignedBigInteger('soum_district_id')->nullable()->after('country_id');
            $table->unsignedBigInteger('bag_khoroo_id')->nullable()->after('soum_district_id');

            // Add foreign keys if needed
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('soum_district_id')->references('id')->on('soum_districts')->onDelete('set null');
            $table->foreign('bag_khoroo_id')->references('id')->on('bag_khoroos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['soum_district_id']);
            $table->dropForeign(['bag_khoroo_id']);
            $table->dropColumn(['country_id', 'soum_district_id', 'bag_khoroo_id']);
        });
    }
};
