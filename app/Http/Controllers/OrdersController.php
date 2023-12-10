<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
public function create_order()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message :', 'User not authenticated'], 401);
    }

    $cart = Cart::where('user_id', $user->user_id)->latest()->first();
    if (!$cart) {
        return response()->json(['message :', 'Cart not found'], 404);
    }

    $cart_id = $cart->cart_id;

    $order = Order::create([
        'user_id'=> $user->user_id,
        'cart_id'=>$cart_id,
        
    ]);
    
 return response()->json(['message :', 'created order successfully'], 404);
}
}
