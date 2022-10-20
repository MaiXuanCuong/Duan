<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'phone' => 'required|min:9',
            
           ];
            return $rules;
    }
        public function messages(){
            $messages =[
                'name.required' => 'Hãy Nhập Họ Và Tên Của Bạn',
                'name.min' => 'Hãy Nhập Tên Sản Phẩm Lớn Hơn 3 Ký Tự',
                'email.required' => 'Hãy Nhập Email Của Bạn',
                'email.email' => 'Email Chưa Đúng Định Dạng',
                'province_id.required' => 'Hãy Chọn Tỉnh/Thành Phó Của Bạn',
                'district_id.required' => 'Hãy Chọn Quận/Huyện Của Bạn',
                'ward_id.required' => 'Hãy Chọn Xã/Phường Của Bạn',
                'phone.required' => 'Hãy Nhập Số Điện Thoại Của Bạn',
                'phone.min' => 'Hãy Nhập Số Điện Thoại Lớn Hơn 9 Ký Tự',
            ];
            return $messages;
        }
}
