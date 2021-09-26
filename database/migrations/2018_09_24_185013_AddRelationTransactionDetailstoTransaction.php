<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTransactionDetailstoTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->integer('transaction_id')->unsigned()->change();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            //
        });
    }
}
