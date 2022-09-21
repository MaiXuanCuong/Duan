<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
        'address' => 'required',
        'email' => 'required',
        
        'password' => 'required|min:5',
       ];
        return $rules;
    }
    public function messages(){
        $messages =[
            'name.required' => 'Hãy Nhập Tên Của Bạn',
            'name.min' => 'Hãy Nhập Tên Lớn Hơn 3 Ký Tự',
            'address.required' => 'Hãy Nhập Địa Chỉ',
            'email.required' => 'Hãy Nhập Địa Chỉ email',
            
            'password.required' => 'Hãy Nhập Mật Khẩu',
            'password.min' => 'Hãy Nhập Mật Khẩu Từ 6 Ký Tự',
           
        ];
        return $messages;
    }
}
