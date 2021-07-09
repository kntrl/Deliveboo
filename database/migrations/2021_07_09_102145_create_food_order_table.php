<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_order', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')->on('foods');
            $table->integer('quantity');
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('food_order', function(Blueprint $table){
            $table->dropForeign('food_order_food_id_foreign');
            $table->dropForeign('food_order_order_id_foreign');
            $table->dropColumn('food_id');
            $table->dropColumn('order_id');
        });

        Schema::dropIfExists('food_order');
    }
}
