<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $totalPrice  =  Order::pluck('total')->sum();
        $totalOrders  =  Order::pluck('id')->count();
        $totalCustomer  =  Customer::pluck('id')->count();
        $topProducts = DB::table('orders_detail')
            ->leftJoin('products', 'products.id', '=', 'orders_detail.product_id')
            ->selectRaw('products.*, sum(orders_detail.quantity) totalProduct, sum(orders_detail.total) totalPrice')
            ->groupBy('orders_detail.product_id')
            ->orderBy('totalProduct', 'desc')
            ->take(5)
            ->get();
            $topCustomer = DB::table('customers')
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->selectRaw('customers.*, sum(orders.total) totalOrder')
            ->groupBy('customers.id')
            ->orderBy('totalOrder', 'desc')
            ->take(5)
            ->get();
        $params = [
            'totalPrice' => $totalPrice,
            'totalOrders' => $totalOrders,
            'totalCustomer' => $totalCustomer,
            'topProducts' => $topProducts,
            'topCustomer' => $topCustomer,
        ];
        return view('index',$params);
    }
   
}
