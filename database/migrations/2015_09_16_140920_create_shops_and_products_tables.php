<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsAndProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->default('');
			$table->string('slug')->default('');
			$table->decimal('latitude', 25, 22);
			$table->decimal('longitude', 25, 22);
            $table->timestamps();
        });
		
		Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('shop_id')->unsigned()->default(0);
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
			$table->string('name')->default('');
			$table->string('slug')->default('');
			$table->decimal('price');
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
        Schema::drop('products');
		Schema::drop('shops');
    }
}
