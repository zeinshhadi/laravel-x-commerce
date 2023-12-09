<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
protected $primaryKey = "product_id";
protected $fillable = ["name","description","seller_id","price","stock_quantity"]; 
}
