<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;// add soft delete
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'orderdetail','product_id','order_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
