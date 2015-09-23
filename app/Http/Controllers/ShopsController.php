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

    protected $updaterules = [
        'name' => ['required', 'min:3'],
        'latitude' => ['required', 'numeric' ],
        'longitude' => ['required', 'numeric' ],
    ];
    
	
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
		$shops = Shop::all();
        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request
     * @return redirect with a message
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
     * @param  Shop
     * @return view
     */
    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shop
     * @return view
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Shop
     * @param  Request
     * @return redirect with a message
     */
    public function update(Shop $shop, Request $request)
    {
		$this->validate($request, $this->updaterules);
        $input = Input::all();
		$shop->update($input);
		return Redirect::route('shops.show', $shop->slug)->with('message', 'Shop updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Shop
     * @return redirect with a message
     */
    public function destroy(Shop $shop)
    {
		$shop->delete();
		return Redirect::route('shops.index')->with('message', 'Shop deleted.');
    }
}
