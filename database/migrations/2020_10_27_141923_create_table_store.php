<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('mobile_phone');
            $table->string('slug');
            $table->string('postal_code',20)->nullable();
            $table->string('street',100)->nullable();
            $table->string('house_number',20)->nullable();
            $table->string('complement',100)->nullable();
            $table->string('neighborhood',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('BRASIL');

            $table->timestamps();
            // chave estrangeira para a coluna user_id
            // nome da chave estrangeira: stores_user_id_foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
