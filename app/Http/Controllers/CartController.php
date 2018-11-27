<?php

namespace App\Http\Controllers;

use App\Cart_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'aantal' => 'gt:0'
        ]);

        $cart_item = new Cart_item();
        $cart_item->cart_id = auth()->user()->id;
        $cart_item->product_id = $request->id;
        $cart_item->aantal = $request->input('aantal');

        $cart_item->save();
        return redirect('/winkel')->with('success', 'Product Toegevoegd aan winkelwagen');
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
            'aantal' => 'gt:0'
        ]);

        $cart_item = Cart_item::find($id);

        $cart_item->aantal = $request->input('aantal');

        $cart_item->save();

        return redirect('/winkel')->with('success', 'Product Aangepast in de winkelwagen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('cart_items')->where('cart_id', $id)
            ->delete();

        return redirect('/winkelwagen')->with('success', 'Betaald');
    }
}
