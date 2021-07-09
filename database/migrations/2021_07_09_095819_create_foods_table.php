<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('ingredients');
            $table->float('price',6,2);
            $table->string('course','20');
            $table->tinyInteger('available');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('is_vegan')->default(0);
            $table->tinyInteger('is_veggy')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_lactose_free')->default(0);
            $table->tinyInteger('is_gluten_free')->default(0);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('foods', function(Blueprint $table){
            $table->dropForeign('foods_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('foods');
    }
}
