<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart_item extends Model
{
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getCartByUserId($id) {
        $count = DB::table('carts')->where('user_id', $id)->count();
        return $count;
    }
}
