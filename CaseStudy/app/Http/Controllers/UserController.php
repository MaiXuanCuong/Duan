<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassWordByMailRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function store(StoreAdminRequest $request)
    {
        // dd( $request);
        $this->authorize('create', User::class);
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->province_id = $request->province_id;
        $user->district_id = $request->district_id;
        $user->ward_id = $request->ward_id;
        $pass = 'admin';
        $user->password = bcrypt($pass);
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $user->image = $path;
        }
        try {
            $user->save();
            $data = [
                "pass" => $pass,
                'name' => $request->name,
            ];
            $email1 = $request->email;
            $name1 = $request->name;
            Mail::send('admin.emails.add', compact('data'), function ($email) use ($email1, $name1) {
                $email->subject('XC-Shop');
                $email->to($email1, $name1);
            });
            DB::commit();
            alert()->success('Thêm Tài Khoản: ' . $request->name, 'Thành Công');
            return redirect()->route('users');
        } catch (\Exception $e) {
            $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            DB::rollBack();
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            alert()->error('Thêm Tài Khoản: ' . $request->name, 'Không Thành Công!');
            return back()->withInput();
        }
    }
    public function login(StoreLoginRequest $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($arr)) {
            alert()->success('Đăng Nhập Thành Công', 'Chào ' . Auth()->user()->name . ' đến với Admin!');
            return redirect()->route('/');
        } else {
            alert()->error('Đăng Nhập Không Thành Công!', 'Email hoặc mật khẩu không đúng!');
            return back()->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        toast('Đăng Xuất Thành Công!', 'success', 'top-right');
        return redirect()->route('login');
    }
    public function checkLogin()
    {
        if (Auth::check()) {
            return redirect()->route('/');
        } else {
            return view('admin.user.login');
        }
    }
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::search()->latest()->paginate(3);
        $roles = Role::all();
        $params = [
            'users' => $users,
            'roles' => $roles,
        ];
        return view('admin.user.index', $params);
    }
    public function create()
    {
        $this->authorize('create', User::class);
        $provinces = Province::get();
        $params = [
            'provinces' => $provinces,
        ];
        return view('admin.user.register', $params);
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
    public function edit($id)
    {
        $this->authorize('update', User::class);
        $provinces = Province::get();
        $districts = District::get();
        $wards = Ward::get();
        $roles = Role::all();
        $user = User::find($id);
        $user_roles = DB::table('user_roles')->where('user_id', '=', $user->id)->get();
        $params = [
            'roles' => $roles,
            'user' => $user,
            'user_roles' => $user_roles,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];
        return view('admin.user.edit', $params);
    }
    public function update($id, UpdateUserRequest $request)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->province_id = $request->province_id;
        $user->district_id = $request->district_id;
        $user->ward_id = $request->ward_id;
        $user->phone = $request->phone;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $user->image = $path;
        }
        if (isset($request->roles_id)) {
            $roles_id = $request->roles_id;
            $user->roles()->sync($roles_id);
        }
        $item = User::findOrFail($id);
        if (isset($item->image) && isset($path)) {
            $images = str_replace('storage', 'public', $item->image);
        }
        try {
            $user->save();
            if (isset($path) && isset($images)) {
                Storage::delete($images);
            }
            toast(__('messages.msg_user_up_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('users');
        } catch (\Exception $e) {
            if (isset($path)) {

                $images = $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            toast(__('messages.msg_user_up_err', ['name' => $request->name]), 'error', 'top-right');
            return back()->withInput();
        }
    }
    public function updateProfile($id, UpdateUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->province_id = $request->province_id;
        $user->district_id = $request->district_id;
        $user->ward_id = $request->ward_id;
        $user->phone = $request->phone;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $user->image = $path;
        }
        if (isset($request->roles_id)) {
            $roles_id = $request->roles_id;
            $user->roles()->sync($roles_id);
        }
        $item = User::findOrFail($id);
        if (isset($item->image) && isset($path)) {
            $images = str_replace('storage', 'public', $item->image);
        }
        try {
            $user->save();
            if (isset($path) && isset($images)) {
                Storage::delete($images);
            }
            toast(__('messages.msg_user_up_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('users');
        } catch (\Exception $e) {
            if (isset($path)) {

                $images = $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            toast(__('messages.msg_user_up_err', ['name' => $request->name]), 'error', 'top-right');
            return back()->withInput();
        }
    }
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        try {
            DB::beginTransaction();
            $user = User::find($id);
            DB::table('user_roles')->where('user_id', '=', $user->id)->delete();
            User::find($id)->delete();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status: 200);
        } catch (Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            DB::rollBack();
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status: 200);
        }
    }
    public function garbageCan()
    {
        $this->authorize('viewgc', User::class);
        $items = User::search()->onlyTrashed()->paginate(3);
        return view('admin.user.Garbage_can', compact('items'));
    }
    public function restore($id)
    {
        try {
            $this->authorize('restore', User::class);
            $item = User::withTrashed()->where('id', $id);
            $item->restore();
            $item = User::findOrFail($id);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());

            return response()->json([
                'code' => 404,
                'message' => 'failed',
            ], status: 200);
        }
    }
    public function forceDelete($id)
    {
        $this->authorize('forceDelete', User::class);
        $item = User::onlyTrashed()->findOrFail($id);
        $images = str_replace('storage', 'public', $item->image);
        try {
            User::withTrashed()->where('id', $id)->forceDelete();
            Storage::delete($images);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status: 200);
        }
    }

    public function profile()
    {
        $user = User::findOrFail(Auth()->user()->id);
        $provinces = Province::get();
        $districts = District::get();
        $wards = Ward::get();
        $params = [
            'user' => $user,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];
        return view("admin.user.usersprofile", $params);
    }
    public function changePassword(Request $request)
    {
        try {
            if ($request->renewpassword == $request->newpassword) {
                if ((Hash::check($request->password, Auth::user()->password))) {
                    $user = User::findOrFail(Auth()->user()->id);
                    $user->password = bcrypt($request->newpassword);
                    $user->save();
                    toast('Đổi Mật Khẩu Thành Công!', 'success', 'top-right');
                    return back()->withInput();
                } else {
                    toast('Nhập Sai Mật Khẩu Cũ', 'error', 'top-right');
                    return back()->withInput();
                }
            } else {
                toast('Xác Nhận mật Khẩu Không Khớp', 'error', 'top-right');
                return back()->withInput();
            }
        } catch (\Exception $e) {
            toast('Lỗi Không Mong Muốn', 'error', 'top-right');
            return back()->withInput();
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
        }
    }
    public function fogetPassword(Request $request)
    {
        try {
            if (isset(Auth()->user()->name)) {
                if (isset($request->email)) {
                    if (isset($request->email) && isset($request->token)) {
                        $user = User::findOrFail(Auth()->user()->id);
                        if ($user->remember_token == $request->token) {
                            $pass = Str::random(6);
                            $user->password = bcrypt($pass);
                            $user->remember_token = null;
                            $user->save();
                            $name = Auth()->user()->name;
                            $data = [
                                'name' => $name,
                                'pass' => $pass,
                            ];
                            Mail::send('admin.emails.fogetpassword', compact('data'), function ($email) {
                                $email->subject('XC-Shop');
                                $email->to(Auth()->user()->email, Auth()->user()->name);
                            });
                            toast('Đã Gửi Mật Khẩu Mới Về Email Của Bạn!', 'success', 'top-right');
                            return redirect()->route('profile');
                        }
                    } else if ($request->email == Auth::user()->email) {
                        $user = User::findOrFail(Auth()->user()->id);
                        $token = Str::random(6);
                        $user->remember_token = $token;
                        $user->save();
                        $name = Auth()->user()->name;
                        $data = [
                            'name' => $name,
                            'token' => $token,
                        ];
                        Mail::send('admin.emails.password', compact('data'), function ($email) {
                            $email->subject('XC-Shop');
                            $email->to(Auth()->user()->email, Auth()->user()->name);
                        });
                        toast('Đã Gửi Mã Xác Nhận!', 'success', 'top-right');
                        return view('admin.user.usersprofile', compact('token'));
                    } else {
                        toast('Email Không Tồn Tại', 'error', 'top-right');
                        return back()->withInput();
                    }
                } else {
                    toast('Bạn Chưa Nhập Email', 'error', 'top-right');
                    return back()->withInput();
                }
            }
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            toast('Lỗi Không Mong Muốn', 'error', 'top-right');
            return back()->withInput();
        }
    }
    public function changepassmail(ChangePassWordByMailRequest $request){
        $user = DB::table('users')->where('email', $request->emails)->first();
        if(!$user){
            toast('Email: ' . $request->emails.'<br> Không tồn tại', 'error', 'top-right');
            return back()->withInput(); 
        }
        if($request->emails == $user->email){
            try {
            $password = Str::random(6);
            $item=User::find($user->id);
            $item->password= bcrypt($password);
            $item->save();
            $params = [
                'name' => $user->name,
                'password' => $password,
            ];
            Mail::send('shop.emails.password', compact('params'), function ($email) use($user) {
                $email->subject('TCC-Shop');
                $email->to($user->email, $user->name);
            });
            toast('Gửi yêu cầu mật khẩu!'.'<br>'.' Thành Công', 'success', 'top-right');
            return back()->withInput();
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            toast('Gửi yêu cầu mật khẩu!'.'<br>'.' Không thành Công', 'error', 'top-right');
           
            return back()->withInput();
        }
        } else{
         
            toast('Email: ' . $request->emails. '<br> Không tồn tại', 'error', 'top-right');
            return back()->withInput();
            }
    }
    
}
