<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreRegisterRequest;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();
        return view('admin.customers.index', compact('customer'));
    }
    public function create(){
        return view('admin.customers.add');
    }
    
    public function store(StoreCustomerRequest $request){
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = $request->password;
        
        // Session::flash('success', 'Thêm thành công '.$request->name);
        try {
            $customer->save();
            alert()->success('Thêm Customer: '.$request->name,'Thành Công');
            return redirect()->route('customers');
        } catch (\Exception $e) {
            alert()->error('Thêm Customer: '.$request->name, 'Không Thành Công!');
            return view('admin.customers.add',compact('request'));
        }
    }

    // public function register(StoreRegisterRequest $request){
    //     $customer = new Customer();
    //     $customer->name = $request->name;
    //     $customer->address = $request->address;
    //     $customer->email = $request->email;
    //     $customer->password = $request->password;
        
    //     // Session::flash('success', 'Thêm thành công '.$request->name);
    //     try {
    //         $customer->save();
    //         alert()->success('Thêm Customer: '.$request->name,'Thành Công');
    //         return redirect()->route('customers');
    //     } catch (\Exception $e) {
    //         alert()->error('Thêm Customer: '.$request->name, 'Không Thành Công!');
    //         return view('admin.customers.add',compact('request'));
    //     }
    // }
    // public function login(StoreLoginRequest $request){
    // $arr=[
    //     'email'=>$request->email,
    //    'password'=>$request->password
    // ];
    // if(Auth::attempt($arr))
    // {
    //     alert()->success('Đăng Nhập Thành Công!','Chào ' . Auth()->user()->name . ' đến với Shop!');
    //     return redirect()->route('/');
    // }else{
    //     alert()->error('Đăng Nhập Không Thành Công!', 'Email hoặc mật khẩu không đúng!');
    //     return redirect()->route('customer.login');
    // }
    // }
    public function edit($id){
        $customer = Customer::find($id);
        return view('admin.customers.edit',compact('customer'));
    }
    public function update(StoreCustomerRequest $request, $id){
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = $request->password;
        if($customer->email == $request->email){
            alert()->error('Email '.$request->email.' Đã Tồn Tại', 'Sửa Không Thành Công!');
            return redirect()->route('customers.edit',$customer->id);
        }
        try {
            $customer->save();
            alert()->success('Lưu Customer: '.$request->name,' Thành Công');
            return redirect()->route('customers');
             // alert('Title','Lorem Lorem Lorem', 'success');
            // alert()->info('Title','Lorem Lorem Lorem');
            // alert()->warning('Title','Lorem Lorem Lorem');
            // alert()->question('Title','Lorem Lorem Lorem');
            // alert()->html('<i>HTML</i> <u>example</u>'," You can use <b>bold text</b>, <a href='//github.com'>links</a> and other HTML tags ",'success');
        } catch (\Exception $e) {
            alert()->error('Lưu Customer: '.$request->name, 'Không Thành Công!');
            return redirect()->route('customers.edit',$customer->id);
        }
    }
    public function destroy($id){
        $customer = Customer::findOrFail($id);
        try {
        $customer->delete();

            if(!$customer->delete()){
                alert()->success('Xóa Customer: '.$customer->name, 'Thành Công');
            }
        } catch (\Exception $e) {
            alert()->error('Xóa Customer: '.$customer->name, 'Không Thành Công!');
            return redirect()->route('customers');

        }
         
        
        return redirect()->route('customers');
    }
}
