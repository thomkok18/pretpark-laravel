<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cover_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attractie() {
        return $this->belongsTo(Attractie::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getCartByUserId($id) {
        $count = DB::table('carts')->where('user_id', $id)->count();
        return $count;
    }
}
