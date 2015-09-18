<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use Illuminate\Http\Request;
use App\SList;
use App\Shop;
use App\Product;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{

    protected $rules = [
        'name' => ['required', 'min:3'],
        'slug' => ['required', 'unique:s_lists,slug'],
        'products' =>['required'],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Shop $shop)
    {
        return view('lists.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Shop $shop)
    {
        $items = $shop->products->lists('name','id');
        return view('lists.create', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Shop $shop, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = Input::all();

        $totalPrice = 0;
        foreach($input['products'] as $product) {
            $p = Product::find($product);
            $totalPrice += $p->price;
        }

        $input['shop_id'] = $shop->id;
        unset($input['products']);
        $input['total_price'] = $totalPrice;
        $list = SList::create( $input );


        $products = $request->input('products');
        $list->products()->attach($products);
        
        return Redirect::route('shops.show', $shop->slug)->with('message', 'Shopping list created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Shop $shop, SList $list)
    {
        return view('lists.show', compact('shop', 'list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Shop $shop, SList $list)
    {
        return view('lists.edit', compact('shop', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Shop $shop, SList $list)
    {
        $this->validate($request, $this->rules);
        
        $input = array_except(Input::all(), '_method');
        $list->update($input);
        
        return Redirect::route('shops.lists.show', [$shop->slug, $list->slug])->with('message','Shopping list updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Shop $shop, SList $list)
    {
        $list->delete();
        
        return Redirect::route('shops.show', $shop->slug)->with('message','Shopping list deleted');
    }
}
