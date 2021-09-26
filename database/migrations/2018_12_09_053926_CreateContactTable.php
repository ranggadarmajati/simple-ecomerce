<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('address')->nullable();
            $table->string('hp_no')->nullable();
            $table->string('telp_no')->nullable();
            $table->string('wa_no')->nullable();
            $table->string('bbm_pin')->nullable();
            $table->string('line_id')->nullable();
            $table->string('facebook_src')->nullable();
            $table->string('instagram_src')->nullable();
            $table->string('youtube_src')->nullable();
            $table->string('rekening_no')->nullable();
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
        Schema::dropIfExists('contact');
    }
}
