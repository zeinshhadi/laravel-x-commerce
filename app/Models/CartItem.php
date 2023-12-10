<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    
    protected $primaryKey = 'cart_id';

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class, 'cart_id', 'cart_id');
    }
}
