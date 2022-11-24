<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreOderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

            Log::error('message:');

        } catch (\Exception $e) {
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
    public function order(StoreOderRequest $request)
    {
        try{
            DB::beginTransaction();
            $order = new Order;
            $order->note = $request->note;
            $order->address = $request->address;
            $order->province_id = $request->province_id;
            $order->district_id = $request->district_id;
            $order->ward_id = $request->ward_id;
            $order->name_customer = $request->name_customer;
            $order->customer_id = Auth::guard('customers')->user()->id;
            $order->phone = $request->phone;
            $order->total = 0;
            $order->save();
            $carts = Cache::get('carts');
            $order_total_price = 0;
            foreach ($carts[Auth::guard('customers')->user()->id] as $productId => $cart) {
                $order_total_price += $cart['price'] * $cart['quantity'];
                OrderDetail::create([
                    'quantity' => $cart['quantity'],
                    'product_id' => $productId,
                    'total' => $cart['price'] * $cart['quantity'],
                    'order_id' => $order->id,
                ]);
                Product::where('id', $productId)->decrement('quantity', $cart['quantity']);
            }
            $order->total= $order_total_price;
            $order->save();
            DB::commit();
            toast(__('messages.msg_add_order_ss'), 'success', 'top-right');
            return redirect()->route('shop.home');
            }catch(\Exception $e){
                DB::rollBack();
                toast(__('messages.msg_add_order_err'), 'error', 'top-right');
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                return redirect()->route('shop.home');
            }

    }
    public function history()
    {

    }
    public function checkOuts(){
        if (isset(Auth::guard('customers')->user()->id)) {
                $carts = Cache::get('carts');
                $provinces = Province::get();
                if ($carts[Auth::guard('customers')->user()->id]) {
                    $carts = array_values($carts[Auth::guard('customers')->user()->id]);
                    $params = [
                        'provinces' => $provinces,
                        'carts' => $carts,
                    ];
        return view('shop.checkout',$params);
    } else {
        return redirect()->route('shop.home');
    }
    }
    }
    public function GetDistricts(Request $request)
    {
        $province_id = $request->province_id;
        $allDistricts = District::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Ward::where('district_id', $district_id)->get();
        return response()->json($allWards);
    }
}
