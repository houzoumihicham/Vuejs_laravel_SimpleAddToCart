<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\carte
 *
 * @mixin \Eloquent
 */
class carte extends Model
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


    public function get_all(){
        return $this::all();
    }

    public function get_user_cart($user_id){
        return $this->where('user_id',$user_id)->get();
    }
}
