<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use Illuminate\Http\Request;

use App\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
	protected $rules = [
		'name' => ['required', 'min:3'],
		'slug' => ['required', 'unique:shops,slug'],
		'latitude' => ['required', 'numeric' ],
		'longitude' => ['required', 'numeric' ],
	];
	
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$shops = Shop::all();
        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
		$this->validate($request, $this->rules);
        $input = Input::all();
		Shop::create( $input );
	 
		return Redirect::route('shops.index')->with('message', 'Shop registered');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Shop $shop, Request $request)
    {
		$this->validate($request, $this->rules);

        $input = array_except(Input::all(), '_method');
		$shop->update($input);
	 
		return Redirect::route('shops.show', $shop->slug)->with('message', 'Shop updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Shop $shop)
    {
		$shop->delete();
 
		return Redirect::route('shops.index')->with('message', 'Shop deleted.');
    }
}
