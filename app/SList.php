<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SList extends Model
{
	protected $guarded = [];
	
	protected $fillable = [
        'name',
        'slug',
        'shop_id',
        'total_price',
    ];

    /**
     * @return products written on the list
     */
    public function products(){
		return $this->belongsToMany('App\Product')->withTimestamps()->withPivot('quantity');
	}
	
	/**
	 * @return shop, for which is the given list
	 */
	public function shops(){
		return $this->belongsTo('App\Shop');
	}
}
