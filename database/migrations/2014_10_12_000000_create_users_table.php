<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name','70');
            $table->string('piva','11')->unique();
            $table->string('phone','10')->unique();
            $table->string('address');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->decimal('vote',2,1)->default(null)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
