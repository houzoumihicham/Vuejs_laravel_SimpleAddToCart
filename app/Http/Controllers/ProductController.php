<?php

namespace App\Http\Controllers;

use App\products;
use Auth;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{

    public function add_to_cart($product_id){

     return Auth::user()->add_product_to_cart($product_id);

    }

    public function remove_product_carte($product_id){

       return Auth::user()->remove_product_from_carte($product_id);

    }

    public function get_image($id){
        return $prd=Storage::url(products::findOrFail($id)->image);

    }

    public function get_product($product_id){
       return  products::findOrFail($product_id);
    }

    public function add_product_to_favoris($product_id){
       return  Auth::user()->add_products_to_favoris($product_id);

    }

    public function is_product_favoris($product_id){
        return Auth::user()->is_user_favorit_product($product_id);
    }

    public function remove_product_favoris($product_id){
     return Auth::user()->remove_product_in_favoris($product_id);
    }



}
