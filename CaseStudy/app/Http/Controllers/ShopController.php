<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index(){
        $items = Product::search()->paginate(100);
        $Apple = DB::table('products')
        ->select('products.*','categories.name as name_category')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('categories.name','Apple')
        ->get();
        $Realme = DB::table('products')
        ->select('products.*','categories.name as name_category')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('categories.name','Realme')
        ->get();
        $SamSung = DB::table('products')
        ->select('products.*','categories.name as name_category')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('categories.name','SamSung')
        ->get();
        $Xiaomi = DB::table('products')
        ->select('products.*','categories.name as name_category')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('categories.name','Xiaomi')
        ->get();
        $categories =Category::all();
        $params = [
            'items' => $items,
            'Apple' => $Apple,
            'Realme' => $Realme,
            'SamSung' => $SamSung,
            'Xiaomi' => $Xiaomi,
            'categories' => $categories,
        ];
        return view('shop.index', $params);
    }
    
}
