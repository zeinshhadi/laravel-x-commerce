<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{ public $timestamps = false;
    use HasFactory;
    protected $primaryKey= "transaction_id";
    protected $fillable=["order_id","payment_method","total_amount","user_id"];
}
