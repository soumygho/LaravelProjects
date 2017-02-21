<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductmasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productmaster',function(Blueprint $table){
            $table->increments('prod_id');
            $table->string('prod_name')->unique();
            $table->string('spec');
            $table->string('img_url');
            $table->integer('category_id')->unsigned();
			$table->integer('org_id')->unsigned();
			$table->foreign('category_id')->references('category_id')->on('category')->onDelete('cascade');
			$table->foreign('org_id')->references('id')->on('angulara.org')->onDelete('cascade');
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
        Schema::drop('productmaster');
    }
}
