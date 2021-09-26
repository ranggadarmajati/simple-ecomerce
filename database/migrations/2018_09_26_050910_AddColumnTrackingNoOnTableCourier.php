<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTrackingNoOnTableCourier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->string('tracking_number')->nullable();
        });

        Schema::table('order_confirms', function (Blueprint $table) {
            $table->date('transfer_date')->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('couriers', function (Blueprint $table) {
            $table->dropColumn('tracking_number');
        });

        Schema::table('order_confirms', function (Blueprint $table) {
            $table->dropColumn('transfer_date');
        });
    }
}
