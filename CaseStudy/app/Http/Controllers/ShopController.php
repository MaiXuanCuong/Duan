<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $param = [
            'products' => $products,
            'categories' => $categories,
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

            $products = Product::all();
            $id_customer = Auth::guard('customers')->user()->id;
            $carts = Customer::find($id_customer);
            $carts->products;
            // dd($carts->products);
            $param = [
                'products' => $products,
                'carts' => $carts->products,
            ];
            return view('shop.cart', $param);
        } else {
            return view('shop.customers.login');
        }
    }
    public function store($id)
    {
        try {
            $id_customer = Auth::guard('customers')->user()->id;
            $carts = new Cart();
            $carts->product_cart = $id;
            $carts->customer_cart = $id_customer;
            $carts->save();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 303,
                'message' => 'error',
            ], status:200);
        }
    }
    public function update(Request $request)
    {
       
    }
    public function remove($id)
    {
        if (isset(Auth::guard('customers')->user()->id)) {
            try {
                $id_customer = Auth::guard('customers')->user()->id;
                DB::table('carts')
                ->where('product_cart', $id)
                ->where('customer_cart', $id_customer)
                ->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                ], status:200);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 303,
                    'message' => 'error',
                ], status:200);
            }
        }
    }
    public function order(Request $request)
    {
        
    }
    public function history()
    {
        
}
