<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    protected $fillable = array('id', 'org_name');
	public function products()
	{
		return $this->hasMany('App\ProductMaster','org_id','id')->get();
	}
}
