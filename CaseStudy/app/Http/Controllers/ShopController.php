<?php

namespace App\Http\Controllers;

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
    
    public function view($id){
        // $id=1;
        $products = Product::findOrFail($id);
        $params = [
            'product' => $products,
        ];
        return view('shop.product', $params);
    }

    public function cart()
    {
        $products = Product::all();
        $categories = Category::all();
        $param = [
            'products' => $products,
            'categories' => $categories,
        ];
        return view('shop.cart', $param);
    }
    public function store($id)
    {   
      
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nameVi" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                'image' => $product->image,
                'max' => $product->quantity,
            ];
        }
        session()->put('cart', $cart);
        $data = [];
        $data['cart'] = session()->has('cart');
        return response()->json($data);
        // return route('shop.cart',);

    }
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $totalCart = number_format(($cart[$request->id]["price"]) * $cart[$request->id]["quantity"]);
            $totalAllCart = 0;
            $TotalAllRefreshAjax = 0;
            foreach ($cart as $id => $details) {
                $totalAllCart = $details['price'] * $details['quantity'];
                $TotalAllRefreshAjax += $totalAllCart;
            }
            session()->put('cart', $cart);
            session()->flash('message', 'Cart updated successfully');
            return response()->json([
                'status' => 'cập nhật thành công',
                'totalCart' => '' . $totalCart,
                'TotalAllRefreshAjax' => '' . number_format($TotalAllRefreshAjax),
            ]);
        }
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->put('cart', $cart);
            return response()->json(['status' => 'Xóa đơn hàng thành công']);
        }
    }
    public function checkOuts()
    {
        return view('shop.checkout');
    }

    public function order(Request $request)
    {
        if ($request->product_id == null) {
            return redirect()->back();
        } else {
            $id = Auth::guard('customers')->user()->id;
            $data = Customer::find($id);
            $data->address = $request->address;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            if(isset($request->note))
            {
                $data->note=$request->note;
            }
            $data->save();

            $order = new Order();
            $order->customer_id = Auth::guard('customers')->user()->id;
            $order->date_at = date('Y-m-d H:i:s');
            $order->total = $request->totalAll;
            $order->save();
        }
        try {
            if ($order) {
                $count_product = count($request->product_id);
                for ($i = 0; $i < $count_product; $i++) {
                    $orderItem = new OrderDetail();
                    $orderItem->order_id =  $order->id;
                    $orderItem->product_id = $request->product_id[$i];
                    $orderItem->quantity = $request->quantity[$i];
                    $orderItem->total = $request->total[$i];
                    $orderItem->save();
                    session()->forget('cart');
                    DB::table('products')
                        ->where('id', '=', $orderItem->product_id)
                        ->decrement('quantity', $orderItem->quantity);
                }
                toast('Đặt hàng thành công!', 'success', 'top-right');
                return redirect()->route('shop.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            toast('Đặt hàng thấy bại!', 'error', 'top-right');
            return redirect()->route('shop.index');
        }
    }
    public function history()
    {
        $id=Auth::guard('customers')->user()->id;
        $items=DB::table('customers')
        ->join('orders','customers.id','=','orders.customer_id')
        ->join('orderdetail','orders.id','=','orderdetail.order_id')
        ->join('products','orderdetail.product_id','=','products.id')
        ->select('products.name','products.age','products.color','products.gender',
        'products.price','products.image','orderdetail.quantity','orderdetail.total',
        'orderdetail.created_at','customers.id','orders.id' )->where('customers.id','=',$id)
        ->orderby('orders.id','DESC')
        ->get();
        return view('shop.historyorder',compact('items'));
    }

    // public function index(){
    //     $items = Product::search()->paginate(100);
    //     $Apple = DB::table('products')
    //     ->select('products.*','categories.name as name_category')
    //     ->join('categories', 'categories.id', '=', 'products.category_id')
    //     ->where('categories.name','Apple')
    //     ->get();
    //     $Realme = DB::table('products')
    //     ->select('products.*','categories.name as name_category')
    //     ->join('categories', 'categories.id', '=', 'products.category_id')
    //     ->where('categories.name','Realme')
    //     ->get();
    //     $SamSung = DB::table('products')
    //     ->select('products.*','categories.name as name_category')
    //     ->join('categories', 'categories.id', '=', 'products.category_id')
    //     ->where('categories.name','SamSung')
    //     ->get();
    //     $Xiaomi = DB::table('products')
    //     ->select('products.*','categories.name as name_category')
    //     ->join('categories', 'categories.id', '=', 'products.category_id')
    //     ->where('categories.name','Xiaomi')
    //     ->get();
    //     $categories =Category::all();
    //     $params = [
    //         'items' => $items,
    //         'Apple' => $Apple,
    //         'Realme' => $Realme,
    //         'SamSung' => $SamSung,
    //         'Xiaomi' => $Xiaomi,
    //         'categories' => $categories,
    //     ];
    //     return view('shop1.index',$params);
    // }
    // public function cart(){
    //     $items = Product::search()->paginate(100);
    //     $params = [
    //         'items' => $items,
           
    //     ];
    //     return view('shop1.cart',$params);
    // }
    // public function checkout(){
    //     return view('shop1.checkout');
    // }
  
 

    
} 
