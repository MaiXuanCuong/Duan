<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOderRequest extends FormRequest
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
        'quantity' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'configuration' => 'required',
        'quantity' => 'required',
        'color' => 'required',
        'name' => 'required|min:3',
       ];
        return $rules;
    }
    public function messages(){
        $messages =[
            'name.required' => 'Hãy Nhập Tên Của Bạn',
            'address.required' => 'Hãy Nhập Địa Chỉ Giao Hàng',
            'quantity.required' => 'Hãy Nhập Số Lượng Sản Phẩm',
            'configuration.required' => 'Hãy Nhập Cấu Hình Sản Phẩm',
            'color.required' => 'Hãy Nhập Màu Sản Phẩm',
            'name.required' => 'Hãy Nhập Tên Người Đặt Hàng',
            'phone.required' => 'Hãy Nhập Số Điện Thoại',
          
           
        ];
        return $messages;
    }
}
