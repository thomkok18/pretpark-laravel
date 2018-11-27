<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Cart_item;
use App\Product;
use Illuminate\Http\Request;

class Cart_itemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::find(auth()->user()->id);

        $cart_items = Cart_item::paginate(5);
        $product = new Product();

        return view('pages/winkelwagen', compact('cart_items', 'cart', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'aantal' => 'required'
        ]);

        $cart_item = Cart_item::find($id);

        if ($request->input('aantal') != 0) {
            $cart_item->aantal = $request->input('aantal');

            $cart_item->save();

            return redirect('/winkelwagen')->with('success', 'Product Aangepast');
        } else {
            $this->destroy($cart_item->id);
            return redirect('/winkelwagen')->with('success', 'Product weggehaald');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart_item = Cart_item::find($id);

        if (auth()->user()->id == $cart_item->cart_id) {
            $cart_item->delete();
        }
        return redirect('/winkelwagen')->with('success', 'Product Verwijderd uit het Winkelwagentje');
    }
}
