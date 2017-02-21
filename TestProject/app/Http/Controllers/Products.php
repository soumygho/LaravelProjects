<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductMaster;
class Products extends Controller
{
	public function showAll()
	{
		$products =  ProductMaster::orderBy('prod_id', 'asc')->get();
		   $res =  array();
		   $i = 0;
		   foreach($products as $product)
		   {
			   $productsArray =  array();
			   $productsArray["product"] = $product;
			   $productsArray["category"]=$product->category();
			   $productsArray["subcategory"]=$product->subcategory();
			   $productsArray["flipkartproduct"] = $product->flipkartProduct();
			   $res[$i] = $productsArray;
				++$i;
		   }
		   return $res;
	}
    public function index($searchQuery = null){
		$products =  ProductMaster::orderBy('prod_id', 'asc')->get();
		   $res =  array();
		   $i = 0;
		   foreach($products as $product)
		   {
			   $productsArray =  array();
			   $productsArray["product"] = $product;
			   $productsArray["category"]=$product->category();
			   $productsArray["subcategory"]=$product->subcategory();
			   $productsArray["flipkartproduct"] = $product->flipkartProduct();
			   $res[$i] = $productsArray;
				++$i;
		   }
		   return $res;
	}
	
	

}
