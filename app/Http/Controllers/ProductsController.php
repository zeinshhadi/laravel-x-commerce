<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{


        public function __construct()
    {
        $this->middleware('auth:api');
    }


public function add_product(Request $req){
 
    if (auth()->check() ) {
      
        $user = auth()->user();
           if ($user && $user->role_id == 1) {
        $product = Product::create([
            "name" => $req->name,
            "description" => $req->description,
           "seller_id" => $user->user_id,
            "price" => $req->price,
            "stock_quantity" => $req->stock_quantity,
        ]);

    
        return response()->json(['message' => 'Product added successfully']);
    
}else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


}else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
}

public function deleteProduct($productId)
{
    if (auth()->check()) {
        $user = auth()->user();


        if ($user && $user->role_id == 1) {
      
            $product = Product::find($productId);

            if ($product && $user->user_id == $product->seller_id) {
                $product->delete();
                return response()->json(['message' => 'Product deleted successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}


    }

