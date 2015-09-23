<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use Illuminate\Http\Request;

use App\SList;
use App\Product;
use App\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
	protected $rules = [
		'name' => ['required', 'min:3'],
		'slug' => ['required'],
		'price' => ['required', 'numeric'],
	];
    /**
     * Display a listing of the resource.
     * @param  Shop
     * @return view
     */
    public function index(Shop $shop)
    {
        return view('products.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  Shop
     * @return view
     */
    public function create(Shop $shop)
    {
        return view('products.create', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Shop
     * @param  Request
     * @return redirect with a message
     */
    public function store(Shop $shop, Request $request)
    {
		$this->validate($request, $this->rules);
		
        $input = Input::all();
		$input['shop_id'] = $shop->id;
		Product::create( $input );
		
		return Redirect::route('shops.show', $shop->slug)->with('message', 'Product registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  Shop
     * @param  Product
     * @return view
     */
    public function show(Shop $shop, Product $product)
    {
        return view('products.show', compact('shop', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shop
     * @param  Product
     * @return view
     */
    public function edit(Shop $shop, Product $product)
    {
        return view('products.edit', compact('shop', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Shop
     * @param  Product
     * @param  Request
     * @return redirect with a message
     */
    public function update(Shop $shop, Product $product, Request $request)
    {
		$this->validate($request, $this->rules);
        $input = Input::all();
		$product->update($input);
		return Redirect::route('shops.products.show', [$shop->slug, $product->slug])->with('message','Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Shop
     * @param  Product
     * @return redirect with a message
     */
    public function destroy(Shop $shop, Product $product)
    {
        $product->delete();
		return Redirect::route('shops.show', $shop->slug)->with('message','Product deleted');
    }
}
