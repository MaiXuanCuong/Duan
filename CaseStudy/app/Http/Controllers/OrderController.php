<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOderRequest;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(){
        $order = Order::all();
        return view('customers.orders.index', compact('order'));
    }
    public function create(){
        return view('customers.orders.add');
    }
    
    public function store(StoreOderRequest $request){
        DB::beginTransaction();
        $order = new Order();
        $order->quantity = $request->quantity;
        $order->note = $request->note ;
        $order->address = $request->address;
        $order->configuration = $request->configuration;
        $order->color = $request->color;
        $order->name = $request->name;
        $order->customer_id  = 1;
        // Session::flash('success', 'Thêm thành công '.$request->name);
       
            $orderdetail = new OrderDetail();
            $orderdetail->product_id = $request->product_id;
            $orderdetail->order_id = $request->order_id;
            $orderdetail->total = $request->product_id;
        try {
            $order->save();
            $orderdetail->save();
            alert()->success('Thêm Đơn Đặt: '.$request->name,'Thành Công');
            DB::commit();
            return redirect()->route('orders');
        } catch (\Exception $e) {
            alert()->error('Thêm Đơn Đặt: '.$request->name, 'Không Thành Công!');
            DB::rollBack();
            return view('customers.orders.add',compact('request'));
        }
    }
    
  
    public function destroy($id){
        $order = Order::findOrFail($id);
        try {
        $order->delete();

            if(!$order->delete()){
                alert()->success('Xóa Đơn Đặt: '.$order->name, 'Thành Công');
            }
        } catch (\Exception $e) {
            alert()->error('Xóa Đơn Đặt: '.$order->name, 'Không Thành Công!');
            return redirect()->route('orders');

        }
         
        
        return redirect()->route('orders');
    }
    public function show($id){
        $order = Order::findOrFail($id);
      $detail =  $order->orderdetail->id;
      $orderdetail = OrderDetail::findOrFail($detail);
      return view('customer.orderdetail', compact('orderdetail'));
    }
}
