<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reactie extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attractie() {
        return $this->belongsTo(Attractie::class);
    }

    public function getReactiesByAttractieId($id) {
        $count = DB::table('reacties')->where('attractie_id', $id)->count();
        return $count;
    }
}
