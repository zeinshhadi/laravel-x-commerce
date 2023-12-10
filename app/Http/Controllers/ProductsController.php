<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{


        public function __construct()
    {
        $this->middleware('auth:api');
    }


public function add_product(Request $req){
 
    if (auth()->check() ) {
      
        $user = Auth::user();
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

public function delete_product($productId)
{
    if (auth()->check()) {
       $user = Auth::user();


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

public function update_product(Request $req){
if(auth()->check()){

    $user = Auth::user();
    if ($user && $user->role_id == 1) {


            $id_product = $req->product_id;


    $product = Product::find($id_product);
    
    if ($product && $user->user_id == $product->seller_id) {

            $updateFields = [
            'name' => $req->name,
            'description' => $req->description,
            'price' => $req->price,
            'stock_quantity' => $req->stock_quantity,
];

$product->update($updateFields);


return response()->json(['message' => 'Product updated successfully']);
  }else{
        return response()->json(['error'=>'Unauthorized'],401);
    }


    }else{
        return response()->json(['error'=>'Unauthorized'],401);
    }
}else{
        return response()->json(['error'=>'Unauthorized'],401);
    }


}
public function get_products()
{
    if (auth()->check()) {
        $user = Auth::user();

        if ($user && $user->role_id == 1) {
            $seller_id = $user->user_id;

            $products = Product::where('seller_id', $seller_id)->get();

            return response()->json([
                "products" => $products,
                "message" => 'Products displayed successfully'
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized Role'], 401);
        }
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

}