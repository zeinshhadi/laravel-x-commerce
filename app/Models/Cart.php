<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
