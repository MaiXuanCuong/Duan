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
    protected $fillable = ['name','image','price','describe','quantity','specifications','color','price_product','configuration','category_id','user_id'];
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
    public function customers(){
        return $this->belongsToMany(Customer::class,'carts','product_cart','customer_cart');
    }
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->join('categories','categories.id','=','products.category_id')
            ->join('users','users.id','=','products.user_id')
            ->select('products.*','categories.name as name_category')
            ->where('products.name', 'like', '%' . $key . '%')
            ->orwhere('price', 'like', '%' . $key . '%')
            ->orwhere('categories.name', 'like', '%' . $key . '%')
            ->orwhere('color', 'like', '%' . $key . '%')
            ->orwhere('quantity', 'like', '%' . $key . '%')
            ->orwhere('users.name', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
