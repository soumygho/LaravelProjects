<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory',function(Blueprint $table){
            $table->increments('subcategory_id');
            $table->string('subcategory_name')->unique();
            $table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('category_id')->on('category')->onDelete('cascade');
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
        Schema::drop('subcategory');
    }
}
