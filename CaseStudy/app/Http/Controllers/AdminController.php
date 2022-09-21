<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Aler;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;

class AdminController extends Controller
{
    //
    public function register(StoreAdminRequest $request){
        // dd( $request);
        $admin = new User();
        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = bcrypt($request->password);
        
        // Session::flash('success', 'Thêm thành công '.$request->name);
        try {
            if($request->password == $request->password1){
                // dd($admin);
                $admin->save();
                alert()->success('Thêm Tài Khoản: '.$request->name,'Thành Công');
                return view('admin.login');
            } else {
                alert()->error('Thêm Tài Khoản: '.$request->name, 'Không Thành Công!');
                return redirect()->route('admin.login');
            }
        } catch (\Exception $e) {
            alert()->error('Thêm Tài Khoản: '.$request->name, 'Không Thành Công!');
            return redirect()->route('admin.login');
        }
    }
    public function login(StoreLoginRequest $request){
    $arr=[
        'email'=>$request->email,
       'password'=>$request->password
    ];
//    dd($arr);
    if(Auth::attempt($arr))
    {
        alert()->success('Đăng Nhập Thành Công','Chào '.Auth()->user()->name.' đến với Admin!');
        return redirect()->route('/');
    }else{
        alert()->error('Đăng Nhập Không Thành Công!', 'Email hoặc mật khẩu không đúng!');
        return redirect()->route('login');
    }
    }
    public function logout(){
        Auth::logout();
        toast('Đăng Xuất Thành Công!','success','top-right');
        return redirect()->route('login');
    }
    public function checkLogin(){
        if(Auth::check()){
            return redirect()->route('/');
        } else {
            return view('admin.login');
        }
    }
    //check mật khẩu
    //Hash::check($request->password,$item->pasword)
}
