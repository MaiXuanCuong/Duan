<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return view('admin.customers.index', compact('customer'));
    }
    public function create()
    {
        return view('admin.customers.add');
    }

 

    public function register(StoreRegisterRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);

        // Session::flash('success', 'Thêm thành công '.$request->name);
        try {
            $customer->save();
            alert()->success('Đăng Ký Tài Khoản', 'Thành Công');
            return redirect()->route('shop.login');
        } catch (\Exception$e) {
            alert()->error('Email Đã Tồn Tại', 'Không Thành Công!');
            return back()->withInput();
        }
    }
    public function login(StoreLoginRequest $request)
    {  
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::guard('customers')->attempt($arr)) {
            toast('Đăng nhập thành công!', 'success', 'top-right');
            return redirect()->route('shop.home');
        } else {
            return redirect()->route('shop.login');
        }
    }
    public function logout()
    {
        Auth::guard('customers')->logout();
        toast('Đăng Xuất Thành Công!', 'success', 'top-right');
        return redirect()->route('shop.home');
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit', compact('customer'));
    }
    public function update(StoreCustomerRequest $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = $request->password;
        if ($customer->email == $request->email) {
            alert()->error('Email ' . $request->email . ' Đã Tồn Tại', 'Sửa Không Thành Công!');
            return redirect()->route('customers.edit', $customer->id);
        }
        try {
            $customer->save();
            alert()->success('Lưu Customer: ' . $request->name, ' Thành Công');
            return redirect()->route('customers');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            alert()->error('Lưu Customer: ' . $request->name, 'Không Thành Công!');
            return redirect()->route('customers.edit', $customer->id);
        }
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        try {
            $customer->delete();

            if (!$customer->delete()) {
                alert()->success('Xóa Customer: ' . $customer->name, 'Thành Công');
            }
        } catch (\Exception$e) {
            alert()->error('Xóa Customer: ' . $customer->name, 'Không Thành Công!');
            return redirect()->route('customers');

        }
        return redirect()->route('customers');
    }
}
