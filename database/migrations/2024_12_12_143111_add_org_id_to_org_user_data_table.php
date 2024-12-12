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
        Schema::table('org_user_data', function (Blueprint $table) {
            $table->bigInteger('org_id')->unsigned()->nullable()->after('id');
            $table->foreign('org_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('org_user_data', function (Blueprint $table) {
            $table->dropForeign(['org_id']);
            $table->dropColumn('org_id');
        });
    }
};
