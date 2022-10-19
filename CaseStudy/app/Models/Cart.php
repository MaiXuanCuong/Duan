<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // public function products(){
    //     return $this->belongsToMany(Product::class,'products','product_cart','id');
    // }
    // public function customers(){
    //     return $this->belongsToMany(Customer::class,'customers','customer_cart','id');
    // }
}
