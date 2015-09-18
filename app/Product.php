<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	    protected $guarded = [];

	
    public function shop(){
		return $this->belongsTo('App\Shop');
	}
	
	public function lists(){
		return $this->belongsToMany('App\SList');
	}
}
