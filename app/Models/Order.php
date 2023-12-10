<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = ["cart_id","user_id"];

    public function orders()
    {
        return $this->hasMany(Order::class, 'cart_id', 'cart_id');
    }

}
