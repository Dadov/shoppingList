<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [];

	protected $fillable = [
	   	'shop_id',
	   	'name',
	   	'slug',
	   	'price',
	];

	/**
	 * @return shop, which owns the product
	 */
    public function shop(){
		return $this->belongsTo('App\Shop');
	}
	
	/**
	 * @return lists that contain the product
	 */
	public function lists(){
		return $this->belongsToMany('App\SList')->withPivot('quantity');
	}
}
