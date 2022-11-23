<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index()
    {
        if (isset(Auth::guard('customers')->user()->id)) {
            $carts = Cache::get('carts');
            if ($carts) {
                $carts = array_values($carts[Auth::guard('customers')->user()->id]);
            }} else {
                $carts = [];
            }

        $products = Product::all();
        $categories = Category::all();

        $param = [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
        ];
        return view('shop.index', $param);
    }

    public function view($id)
    {
        $products = Product::findOrFail($id);
        $params = [
            'product' => $products,
        ];
        return view('shop.product', $params);
    }
    public function cart()
    {
        if (isset(Auth::guard('customers')->user()->id)) {
            try {
                $products = Product::all();
                $carts = Cache::get('carts');
                if ($carts[Auth::guard('customers')->user()->id]) {

                    $carts = array_values($carts[Auth::guard('customers')->user()->id]);
                    $param = [
                        'products' => $products,
                        'carts' => $carts,
                    ];
                } else {
                    $carts = [];
                    $param = [
                        'products' => $products,
                        'carts' => $carts,
                    ];
                }
                return view('shop.cart', $param);
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                $carts = [];
                    $param = [
                        'products' => $products,
                        'carts' => $carts,
                    ];
                return view('shop.cart', $param);
            }
        } else {
            return view('shop.customers.login');
        }
    }
    public function store($id)
    {
        try {
            $product = Product::find($id);
            $carts = Cache::get('carts');
            if (isset($carts[Auth::guard('customers')->user()->id][$id])) {
                $carts[Auth::guard('customers')->user()->id][$id]['quantity']++;
                $carts[Auth::guard('customers')->user()->id][$id]['price'] = $product->price;
            } else {
                $carts[Auth::guard('customers')->user()->id][$id] = [
                    'id' => $id,
                    'quantity' => 1,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity_product' => $product->quantity,
                ];
            }
            Cache::put('carts', $carts);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status:200);
        }
    }
    public function update(Request $request)
    {

    }
    public function remove($id)
    {
        try {
            $carts = Cache::get('carts');
            unset($carts[Auth::guard('customers')->user()->id][$id]);
            Cache::put('carts', $carts);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status:200);
        }
    }
    public function order(Request $request)
    {

    }
    public function history()
    {

    }
}
