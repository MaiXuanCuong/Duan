<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required|min:9',
            
           ];
            return $rules;
    }
        public function messages(){
            $messages =[
                'name.required' => 'Hãy Nhập Họ Và Tên Của Bạn',
                'name.min' => 'Hãy Nhập Tên Sản Phẩm Lớn Hơn 3 Ký Tự',
                'email.required' => 'Hãy Nhập Email Của Bạn',
                'address.required' => 'Hãy Nhập Địa Chỉ Của Bạn',
                'phone.required' => 'Hãy Nhập Số Điện Thoại Của Bạn',
                'phone.min' => 'Hãy Nhập Số Điện Thoại Lớn Hơn 9 Ký Tự',
            ];
            return $messages;
        }
}
