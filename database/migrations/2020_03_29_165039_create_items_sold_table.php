<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsSoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_sold', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('order_id');
            $table->double('price', 10,2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     *     $table->integer('item_id');
            $table->string('session_id', 255);
            $table->string('ip_address', 50);
            $table->integer('quantity');
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_sold');
    }
}
