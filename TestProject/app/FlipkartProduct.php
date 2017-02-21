<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlipkartProduct extends Model
{
	protected $table = 'flipkart';
    protected $fillable = array('id', 'flipkart_id',
	'flipkart_url','flipkart_category','flipkart_sub_category',
	'product_id','flipkart_mrp','flipkart_offerprice',
	'flipkart_discount','flipkart_availability',
	'flipkart_effectiveprice','flipkart_color_availability',
	'flipkart_size'
	
	);
	
}



