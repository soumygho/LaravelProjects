<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaster extends Model
{
		protected $table = 'productmaster';
     protected $fillable = array('prod_id', 'prod_name','spec','img_url','category_id','org_id','delivery','warranty','rating','subcategory_id');
	 public function flipkartProduct()
	{
		return $this->hasOne('App\FlipkartProduct','product_id','prod_id')->get();
	}
	public function category()
	{
		return $this->belongsTo('App\Category','category_id','category_id')->get();
	}
	public function subcategory()
	{
		return $this->belongsTo('App\SubCategory','subcategory_id','subcategory_id')->get();
	}
}
