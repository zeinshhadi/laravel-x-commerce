<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function create()
    {
      if (Auth()->check()){
        $user = Auth::user();
        if($user){
      
        $cart = Cart::create(['user_id' => $user->user_id]);
 
        return response()->json(['message' => 'Cart created successfully', 'cart_id' => $cart->cart_id]);

        }else{return response()->json(['message' => 'Cart created failed']);}

      }
    
    

    }

    public function add_item(Request $req){
        
        if(Auth()->check()){
            $user=Auth::user();
            if($user){

               $cart = Cart::where('user_id', $user->user_id)->latest()->first();
                   
                $cart = CartItem::insert([
                    'cart_id' => $cart->cart_id,
                    'product_id'=>$req->product_id,
                    'quantity'=>$req->quantity
                ]);
            }
        }
}
}
