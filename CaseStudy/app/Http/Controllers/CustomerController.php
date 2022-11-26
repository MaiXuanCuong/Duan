<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassWordByMailRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::search()->paginate(3);
        return view('admin.customers.index', compact('customers'));
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
        try {
            $customer->save();
            alert()->success('Đăng Ký Tài Khoản', 'Thành Công');
            if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password])) {
                toast('Đăng nhập thành công!', 'success', 'top-right');
                return redirect()->route('shop.home');
            }
        } catch (\Exception$e) {
            alert()->error('Email Đã Tồn Tại', 'Không Thành Công!');
            return back()->withInput();
        }
    }
    public function login(StoreLoginRequest $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('customers')->attempt($arr)) {
            toast('Đăng nhập thành công!', 'success', 'top-right');
            return redirect()->route('shop.home');
        } else {
            toast('Đăng nhập không thành công!', 'error', 'top-right');
            return back()->withInput();
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
    public function update(Request $request)
    {
        try {
            if (isset(Auth::guard('customers')->user()->id)) {
                $this->validate($request,
                    [
                        'name' => 'required',

                    ],

                    [
                        'required' => ':attribute Không được để trống',
                    ],

                    [
                        'name' => 'Tên',
                    ]

                );
                $customer = Customer::find(Auth::guard('customers')->user()->id);
                $customer->name = $request->name;

                if (!empty($request->passwordOld) && !empty($request->passwordNew) && !empty($request->passwordConfirm)) {
                    $request->validate([
                        'passwordOld' => 'required|min:6',
                        'passwordNew' => 'required|min:6',
                        'passwordConfirm' => 'required|min:6|same:passwordNew',
                    ]);
                    $this->validate($request,
                        [
                            'passwordOld' => 'required|min:6|max:100',
                            'passwordNew' => 'required|min:6|max:100',
                            'passwordConfirm' => 'required|min:6|max:100',
                        ],

                        [
                            'required' => ':attribute Không được để trống',
                            'min' => ':attribute Không được nhỏ hơn :min',
                            'max' => ':attribute Không được lớn hơn :max',
                        ],

                        [
                            'passwordOld' => 'Mật khẩu cũ',
                            'passwordNew' => 'Mật khẩu mới',
                            'passwordConfirm' => 'Xác nhận mật khẩu',
                        ]

                    );
                    if ((Hash::check($request->passwordOld, $customer->password))) {
                        $customer->password = bcrypt($request->passwordNew);

                    }
                }
                $customer->save();
                alert()->success('Thay đổi thông tin', 'Thành Công');

            }
            return redirect()->route('shop.home');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            alert()->error('Đã xãy ra lỗi', 'Sự cố không mong muốn');
            return back()->withInput();
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
    public function changepassmail(ChangePassWordByMailRequest $request)
    {
        $customer = DB::table('customers')->where('email', $request->emails)->first();
        if (!$customer) {
            toast('Email: ' . $request->emails . '<br> Không tồn tại', 'error', 'top-right');
            return back()->withInput();
        }
        if ($request->emails == $customer->email) {
            try {
                $password = Str::random(6);
                $item = Customer::find($customer->id);
                $item->password = bcrypt($password);
                $item->save();
                $params = [
                    'name' => $customer->name,
                    'password' => $password,
                ];
                Mail::send('shop.emails.password', compact('params'), function ($email) use ($customer) {
                    $email->subject('TCC-Shop');
                    $email->to($customer->email, $customer->name);
                });
                toast('Gửi yêu cầu mật khẩu!' . '<br>' . ' Thành Công', 'success', 'top-right');
                return back()->withInput();
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                toast('Gửi yêu cầu mật khẩu!' . '<br>' . ' Không thành Công', 'error', 'top-right');

                return back()->withInput();
            }
        } else {

            toast('Email: ' . $request->emails . '<br> Không tồn tại', 'error', 'top-right');
            return back()->withInput();
        }
    }

}
