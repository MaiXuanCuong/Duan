<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table ='customers';
    protected $fillable = [
        'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $fillable = ['name'];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'carts','customer_cart','product_cart');
    }
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%')
            ->orWhere('email', 'like', '%' . $key . '%');
        }
        return $query;
    }
}