<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attractie extends Model
{
    protected $fillable = ['title', 'description'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
