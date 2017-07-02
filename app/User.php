<?php

namespace App;

use App\Events\AddProductToCart;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cartes()
    {
        return $this->hasMany('App\carte');
    }
    public function favoris()
    {
        return $this->hasMany('App\Favoris');
    }

    public function add_product_to_cart($product_id){

        $carte=carte::create([
            'user_id'=> $this->id,
            'product_id'=>$product_id

        ]);

        return $carte;

    }

    public function remove_product_from_carte($product_id){

        $carte = carte::where('product_id',$product_id)->where('user_id',Auth::user()->id)->delete();
        if($carte){
            return 1;
        }
        return 0;
    }

    public function remove_product_in_carte($product_id){
       $carte= carte::where('user_id',$this->id)->where('product_id',$product_id)->first()->delete();
        if($carte){
            return 1;
        }
        return 0;
    }
    public function remove_product_in_favoris($product_id){
        $favoris= Favoris::where('user_id',$this->id)->where('product_id',$product_id)->first()->delete();
        if($favoris){
            return 1;
        }
        return 0;
    }
    public function get_products_cart(){
        $products=array();
         $cartes=carte::where('user_id',$this->id)->get();

       foreach ($cartes as $cart){
            array_push($products,$cart->products);

        }
      return  $products;
    }

    public function add_products_to_favoris($product_id){
        $favoris=Favoris::create([
            'user_id'=>$this->id,
            'product_id'=>$product_id
        ]);
        return $favoris;
    }
    public function get_favoris(){

         $favoris_products=array();
        $favoris =Auth::user()->favoris;
        foreach ($favoris as $fav){
            array_push($favoris_products,$fav->products->id);
        }
        return $favoris_products;

    }

    public function is_user_favorit_product($product_id){
       if(in_array($product_id, $this->get_favoris())){
           return 1;
       }
       return 0;
    }


}
