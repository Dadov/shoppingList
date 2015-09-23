<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	    protected $guarded = [];

	    protected $fillable = [
	    	'name',
	    	'slug',
	    	'longitude',
	    	'latitude',
	    ];

	/**
	 * @return products owned by this shop
	 */
    public function products(){
		return $this->hasMany('App\Product');
	}
	
	/**
	 * @return lists for this shop
	 */
	public function lists(){
		return $this->hasMany('App\SList');
	}
}
