<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * App\products
 *
 * @mixin \Eloquent
 */
class products extends Model
{

    protected $fillable =['name','image','prix','description'];

    public function cartes()
    {
        return $this->hasMany('App\carte');
    }
    public function favoris()
    {
        return $this->hasMany('App\Favoris');
    }





}
