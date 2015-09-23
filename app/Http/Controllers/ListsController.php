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
    ];

    protected $updaterules = [
        'name' => ['required', 'min:3'],
    ];

    /**
     *Display a listing of the resource.
     * 
     * @param  Shop
     * @return view
     */
    public function index(Shop $shop)
    {
        return view('lists.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  Shop
     * @return view
     */
    public function create(Shop $shop)
    {
        $items = $shop->products;
        return view('lists.create', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  Shop
     * @param  Request
     * @return redirect to route with message
     */
    public function store(Shop $shop, Request $request)
    {
        $this->validate($request, $this->rules);
        $input = Input::all();
        $input['shop_id'] = $shop->id;
        $products = $this->getProducts($shop,$input);
        $quantities = $this->getQuantities($shop,$input);
        $input['total_price'] = $this->getTotalPrice($products,$quantities);
        $list = SList::create( $input );
        foreach ($products as $product) {
            $list->products()->attach($product, array('quantity' => $quantities[$product->id] ));
        }
        return Redirect::route('shops.show', $shop->slug)->with('message', 'Shopping list created');
    }

    /**
     *Display the specified resource.
     * 
     * @param  Shop
     * @param  SList
     * @return view
     */
    public function show(Shop $shop, SList $list)
    {
        return view('lists.show', compact('shop', 'list'));
    }

    /**
     *Show the form for editing the specified resource.
     * 
     * @param  Shop
     * @param  SList
     * @return view
     */
    public function edit(Shop $shop, SList $list)
    {
        return view('lists.edit', compact('shop', 'list'));
    }

    /**
     *Update the specified resource in storage.
     * 
     * @param  Request
     * @param  Shop
     * @param  SList
     * @return redirect with a message
     */
    public function update(Request $request, Shop $shop, SList $list)
    {
        $this->validate($request, $this->updaterules);
        
        $input = Input::all();
        $products = $this->getProducts($shop,$input);
        $quantities = $this->getQuantities($shop,$input);
        $input['total_price'] = $this->getTotalPrice($products,$quantities);
        $list->update($input);
        $list->products()->detach();
        foreach ($products as $product) {
            $list->products()->attach($product, array('quantity' => $quantities[$product->id] ));
        }
        return Redirect::route('shops.lists.show', [$shop->slug, $list->slug])->with('message','Shopping list updated');
    }

    /**
     *Remove the specified resource from storage.
     * 
     * @param  Shop
     * @param  SList
     * @return redirect with a message
     */
    public function destroy(Shop $shop, SList $list)
    {
        $list->delete();
        
        return Redirect::route('shops.show', $shop->slug)->with('message','Shopping list deleted');
    }

    /**
     *This method returns the list of products to be saved on shopping list
     * 
     * @param  Shop
     * @param  input
     * @return products
     */
    private function getProducts(Shop $shop, array $input)
    {
        foreach ($shop->products as $product) {
            if(isset($input[$product->slug])){
                $products[$product->id] = $product;
            }
        }
        return $products;
    }

    /**
     * This method returns the list of quantities of products to be saved on shopping list
     * 
     * @param  Shop
     * @param  input
     * @return quantities
     */
    private function getQuantities(Shop $shop, array $input)
    {
        foreach ($shop->products as $product) {
            if(isset($input[$product->slug])){
                $quantities[$product->id] = $input[$product->slug];
            }
        }
        return $quantities;
    }

    /**
     * This method returns the total price of a shopping list
     * 
     * @param  products
     * @param  quantities
     * @return total price
     */
    private function getTotalPrice(array $products, array $quantities)
    {
        foreach($products as $product) {
            $totalPrice += $product->price*$quantities[$product->id];
        }
        return $totalPrice
    }
}
