<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsToMany(Product::class,'ordersdetail','order_id','product_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
