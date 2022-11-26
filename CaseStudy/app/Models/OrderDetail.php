<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'price_at_time','quantity','product_id','order_id','total'
    ];
    protected $table = 'orders_detail';
    use HasFactory;
    function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
