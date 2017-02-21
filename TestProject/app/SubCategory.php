<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	protected $table = 'subcategory';
    protected $fillable = array('subcategory_id', 'subcategory_name','category_id');
}
