<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTotalToBePaid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_confirms', function (Blueprint $table) {
            $table->string('total_to_be_paid')->before('proof_of_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_confirms', function (Blueprint $table) {
            $table->dropColumn('total_to_be_paid');
        });
    }
}
