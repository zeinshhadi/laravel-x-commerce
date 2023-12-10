<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
  public function create_transaction(Request $req){
    if(Auth()->check()){
        $user= Auth::user();
        $user_id = $user->user_id;
        $order = Order::where('user_id',$user_id)->latest()->first();
        $cart = Cart::where('user_id',$user_id)->latest()->first();
      
  
    $transaction = Transaction::create([
        
        "order_id"=>$order->order_id,
        "user_id"=>$user_id,
        "payment_method"=>$req->payment_method,
        "total_amount"=>$cart->total_price,

    ]);
     return response()->json(['message' => $user_id]);
       }
  }
  
  public function get_transaction(){
    if(Auth()->check()){
      $user = Auth::user();
      if($user){
      $user_id = $user->user_id;
      $transaction=Transaction::where('user_id',$user_id)->get();
      if(!$transaction){
                          return response()->json([
                "products" => $transaction,
                "message" => 'Transactions displayed successfully'
            ]);
      }else{
        return response()->json(['message : No transactions found']);
      }

}else{
  return response()->json(['message : Unauthorizaed']);
}
    }else{
    return response()->json(['message :', 'Unauthorizaed']);
  }
}

}