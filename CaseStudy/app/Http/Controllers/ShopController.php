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
use Carbon\Carbon;
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
            $user = Auth::guard('customers')->user()->id;
            $historyProducts = [];
            $carts = Cache::get('carts'.$user);
            $historyProduct = Cache::get('historyProducts'.$user);
            if (isset($carts[Auth::guard('customers')->user()->id])){
                $carts = array_values($carts);
            }
        
            if (isset($historyProduct)) {
              
               $historyProducts = array_values($historyProduct);
            }
        } else {
                $carts = [];
                $historyProducts = [];
            } 
        $products = Product::all();
        $productsNew = Product::orderBy('id','DESC')->take(6)->get();
        $categories = Category::all();
        $topProducts = DB::table('orders_detail')
        ->leftJoin('products', 'products.id', '=', 'orders_detail.product_id')
        ->selectRaw('products.*, sum(orders_detail.quantity) totalProduct, sum(orders_detail.total) totalPrice')
        ->groupBy('orders_detail.product_id')
        ->orderBy('totalProduct', 'desc')
        ->take(6)
        ->get();
        $param = [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'topProducts' => $topProducts,
            'productsNew' => $productsNew,
            'historyProducts' => $historyProducts,

        ];
        return view('shop.index', $param);
    }

    public function view($id)
    {
        $product = Product::findOrFail($id);
       
        try {
            if(isset(Auth::guard('customers')->user()->id)){
            $user = Auth::guard('customers')->user()->id;
            $historyProducts = Cache::get('historyProducts'.$user);
                $historyProducts[$id] = [
                    'id' => $id,
                    'quantity' => 1,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity_product' => $product->quantity,
                ];
                $expiresAt = Carbon::now()->addMinutes(60);
            Cache::put('historyProducts'.$user, $historyProducts,$expiresAt);
                }
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
        }
        $params = [
            'product' => $product,
        ];
        return view('shop.product', $params);
    }
    public function cart()
    {
        if (isset(Auth::guard('customers')->user()->id)) {
            try {
                $products = Product::search()->get();
                $user = Auth::guard('customers')->user()->id;
                $carts = Cache::get('carts'.$user);
                if ($carts) {

                    $carts = array_values($carts);
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
            if (isset(Auth::guard('customers')->user()->id)) {
                $user = Auth::guard('customers')->user()->id;
                $carts = Cache::get('carts'.$user);
                if(isset($carts[$id])){
                    $carts[$id]['quantity']++;
                    $carts[$id]['price'] = $product->price;
                }else {
                $carts[$id] = [
                    'id' => $id,
                    'quantity' => 1,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity_product' => $product->quantity,
                ];
            }
            } 
            $expiresAt = Carbon::now()->addDays(30);
            Cache::put('carts'.$user, $carts, $expiresAt);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
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
            if (isset(Auth::guard('customers')->user()->id)) {
                $user = Auth::guard('customers')->user()->id;
                $carts = Cache::get('carts'.$user);
                unset($carts[$id]);
                Cache::put('carts'.$user, $carts);
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                ], status:200);
        }
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
            $user = Auth::guard('customers')->user()->id;
            $order = new Order;
            $order->note = $request->note;
            $order->address = $request->address;
            $order->province_id = $request->province_id;
            $order->district_id = $request->district_id;
            $order->ward_id = $request->ward_id;
            $order->name_customer = $request->name_customer;
            $order->customer_id = $user;
            $order->phone = $request->phone;
            $order->total = 0;
            $order->save();
            $carts = Cache::get('carts'.$user);
            $order_total_price = 0;
            foreach ($carts as $productId => $cart) {
                $order_total_price += $cart['price'] * $cart['quantity'];
                OrderDetail::create([
                    'quantity' => $cart['quantity'],
                    'product_id' => $productId,
                    'total' => $cart['price'] * $cart['quantity'],
                    'order_id' => $order->id,
                ]);
                Product::where('id', $productId)->decrement('quantity', $cart['quantity']);
                
            }
            Cache::forget('carts'.$user);
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
            $user = Auth::guard('customers')->user()->id;
                $carts = Cache::get('carts'.$user);
                $provinces = Province::get();
                if ($carts) {
                    $carts = array_values($carts);
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
