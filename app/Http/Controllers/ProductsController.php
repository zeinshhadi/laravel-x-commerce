<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
public function add_product(Request $req){
 
    if (auth()->check()) {
      
        $user_id = auth()->id();
        $product = Product::create([
            "name" => $req->name,
            "description" => $req->description,
            "seller_id" => $user_id,
            "price" => $req->price,
            "stock_quantity" => $req->stock_quantity,
        ]);

    
        return response()->json(['message' => 'Product added successfully']);
    } else {
  
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
}