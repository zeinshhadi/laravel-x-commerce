<?php

namespace App\Http\Controllers;

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
        $order_id = $order->order_id;
 
  
    $transaction = Transaction::create([
        
        "order_id"=>$order->order_id,
        "user_id"=>$user_id,
        "payment_method"=>$req->method,
        "total_amount"=>$req->total_amount,

    ]);
     return response()->json(['message' => $user_id]);
       }
  }
}