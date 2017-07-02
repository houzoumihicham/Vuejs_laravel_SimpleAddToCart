<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    protected $fillable=['user_id','product_id'];

    public function products()
    {
        return $this->belongsTo('App\products','product_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
