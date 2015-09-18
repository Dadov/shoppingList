<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SList extends Model
{
	protected $guarded = [];
	
    public function products(){
		return $this->belongsToMany('App\Product')->withTimestamps();
	}
	
	public function shops(){
		return $this->belongsTo('App\Shop');
	}
}
