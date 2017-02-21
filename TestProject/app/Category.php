<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
    protected $fillable = array('category_id', 'category_name');
	
	public function subCategories()
	{
		return $this->hasMany('App\SubCategory','category_id','category_id')->get();
	}
	public function products()
	{
		return $this->hasMany('App\ProductMaster','category_id','category_id')->get();
	}
}
