<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    
    public function index1(){
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
    // public function cart(){
    //     return view('shop.cart');
    // }
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
        return view('shop1.index',$params);
    }
    public function cart(){
        $items = Product::search()->paginate(100);
        $params = [
            'items' => $items,
           
        ];
        return view('shop1.cart',$params);
    }
    public function checkout(){
        return view('shop1.checkout');
    }
  
    public function singleproduct(){
        return view('shop1.single-product');
    }

    
}
