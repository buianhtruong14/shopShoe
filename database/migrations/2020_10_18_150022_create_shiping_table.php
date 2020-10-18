<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiping', function (Blueprint $table) {
            $table->increments('shiping_id');
            $table->string('shiping_name');
            $table->integer('customer_id');
            $table->string('shiping_phone');
            $table->string('shiping_email');
            $table->text('shiping_address');
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
        Schema::dropIfExists('shiping');
    }
}
