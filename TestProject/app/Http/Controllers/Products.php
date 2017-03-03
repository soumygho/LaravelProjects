<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductMaster;
use App\Products\ProductsRepository;
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
    public function index(){
		
			showAll();
		
		
	}
	public function showProductById($productId)
	{
		$product = ProductMaster::find($productId);
		$res =  array();
		$productsArray =  array();
		$productsArray["product"] = $product;
		$productsArray["category"]=$product->category();
		$productsArray["subcategory"]=$product->subcategory();
		$productsArray["flipkartproduct"] = $product->flipkartProduct();
		$res[0] = $productsArray;
		return $res;
	}
	
	

}
