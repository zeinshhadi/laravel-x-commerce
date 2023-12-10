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
              $qunatity= $req->quantity;
              $product = Product::find($req->product_id);
          
               $cart = Cart::where('user_id', $user->user_id)->latest()->first();
           if(!$cart || !$req->product_id || !$product || !$qunatity)
           {
            
            return response()->json(['error'=>'cant find cart,or product']);
           }
        
           else{
            $item_price = $req->quantity * $product->price;
         
                $cart_item = CartItem::insert([
                    'cart_id' => $cart->cart_id,
                    'product_id'=>$req->product_id,
                    'quantity'=>$req->quantity,
                    'total_price' => $req->quantity * $product->price,
                ]);
                $cart = Cart::find($cart->cart_id);

                $old_price = $cart->total_price;

                 $total= $old_price+$item_price;

                $cart ->total_price =  $total;
                  $cart->save();

                 return response()->json(['message '=>$total]);

                return response()->json(['message '=>'added item']);
                }
            }else{
              return response()->json(['error'=>'cant add item']);
            }
        }else{
          return response()->json(['error'=>'unauthorized']);
        }
}
  public function get_cart(){
    if(Auth()->check()){
      $user = Auth::user();
      if($user){
      $user_id = $user->user_id;
      $cart=Cart::where('user_id',$user_id)->get();
      if($cart){
                return response()->json([
                "carts" => $cart,
                "message" => 'Carts displayed successfully'
            ]);
      }else{
        return response()->json(['message : No carts found']);
      }

}else{
  return response()->json(['message : Unauthorizaed']);
}
    }else{
    return response()->json(['message :', 'Unauthorizaed']);
  }
}

}
