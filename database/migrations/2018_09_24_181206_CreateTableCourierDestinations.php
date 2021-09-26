<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourierDestinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courier_id')->unsigned();
            $table->string('province');
            $table->string('county_town');
            $table->string('district');
            $table->string('post_code');
            $table->string('address');
            $table->timestamps();

            $table->foreign('courier_id')
                  ->references('id')
                  ->on('couriers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_destinations');
    }
}
