<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
class Categories extends Controller
{
   public function index($id=null)
   {
	   if($id==null)
	   {
		   $categories =  Category::orderBy('category_id', 'asc')->get();
		   $res =  array();
		   $i = 0;
		   foreach($categories as $category)
		   {
			   $cat =  array();
			   $cat["category"] = $category;
			   $cat["subcategories"]=$category->subCategories();
			   $res[$i] = $cat;
				++$i;
		   }
		   return $res;
	   }
	   else
	   {
		   return show($id);
	   }
	   
   }
   public function show($id) {
        return Category::find($id);
    }
}
