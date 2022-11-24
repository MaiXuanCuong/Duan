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
        'address' => 'required',
        'province_id' => 'required',
        'district_id' => 'required',
        'ward_id' => 'required',
        'name_customer' => 'required',
        'phone' => 'required',
       ];
        return $rules;
    }
    public function messages(){
        $messages =[
            'address.required' => 'Hãy Nhập Địa Chỉ Giao Hàng',
            'province_id.required' => 'Hãy chọn tỉnh/thành phố',
            'district_id.required' => 'Hãy chọn quận/huyện',
            'ward_id.required' => 'Hãy chọn xã/phường',
            'name_customer.required' => 'Hãy Nhập Tên Của Bạn',
            'phone.required' => 'Hãy Nhập Số Điện Thoại',
          
           
        ];
        return $messages;
    }
}
