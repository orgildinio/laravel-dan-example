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
        Schema::table('complaint_steps', function (Blueprint $table) {
            // Rename the "amount" column to "amount_pay" and change it to decimal
            $table->renameColumn('amount', 'amount_pay');

            // Add the new "amount_recieve" column as decimal
            $table->decimal('amount_recieve', 15, 2)->nullable()->after('amount_pay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_steps', function (Blueprint $table) {
            //
        });
    }
};
