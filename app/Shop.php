<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	    protected $guarded = [];
	
    public function products(){
		return $this->hasMany('App\Product');
	}
	
	public function lists(){
		return $this->hasMany('App\SList');
	}
}
