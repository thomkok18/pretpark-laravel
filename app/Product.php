<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function cartItem()
    {
        return $this->belongsTo(Cart_item::class);
    }

    public function getCartIdByProductUserId($productId, $userId)
    {
        $id = null;
        $carts = DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->select('cart_items.id')
            ->where([['carts.user_id', '=', $userId], ['cart_items.product_id', '=', $productId]])
            ->get();

        foreach ($carts as $cart) {
            $id = $cart->id;
        }

        if ($id !== null) {
            return $id;
        } else {
            return error_log('Id does not exist.');
        }


    }

    public function getCartByProductId($id)
    {
        $count = DB::table('cart_items')->where([['product_id', $id], ['cart_id', auth()->user()->id]])->count();
        return $count;
    }

    public function getProductByUserId($id)
    {
        $count = DB::table('cart_items')->where('cart_id', $id)->sum('aantal');
        return $count;
    }

    public function getPrijsByProductId($id)
    {
        $subtotaal = DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->select(DB::raw('SUM(cart_items.aantal * products.price) as subtotaal'))
            ->where('cart_id', '=', $id)
            ->get();

        foreach ($subtotaal as $sub) {
            $subtotaal = $sub->subtotaal;
        }
        return $subtotaal;
    }

    public function getCartItemByCartId($id)
    {
        $count = DB::table('cart_items')->where('cart_id', $id)->count();
        return $count;
    }

    public function getVerzendskosten($subtotaal)
    {
        if ($subtotaal == 0) {
            return 0;
        } else {
            return 1.25;
        }
    }
}
