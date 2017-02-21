<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlipkartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flipkart',function(Blueprint $table){
			$table->increments('id');
            $table->string('flipkart_id')->unique();
            $table->string('flipkart_url');
            $table->string('flipkart_category');
            $table->string('flipkart_sub_category');
            $table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('prod_id')->on('productmaster')->onDelete('cascade');
			$table->string('flipkart_mrp');
			$table->string('flipkart_offerprice');
			$table->string('flipkart_discount');
			$table->string('flipkart_availability');
			$table->string('flipkart_effectiveprice');
			$table->string('flipkart_color_availability');
			$table->string('flipkart_size');
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
        Schema::drop('flipkart');
    }
}
