<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        'price' => 'required|min:1|max:19',
        'describe' => 'required',
        'configuration' => 'required',
        'quantity' => 'required|min:1|max:19',
        'specifications' => 'required',
        'inputFile' => 'required',
        'color' => 'required',
        'price_product' => 'required'
       ];
        return $rules;
    }
    public function messages(){
        $messages =[
            'name.required' => 'Hãy Nhập Tên Sản Phẩm',
            'name.min' => 'Hãy Nhập Tên Sản Phẩm Lớn Hơn 3 Ký Tự',
            'price.required' => 'Hãy Nhập Giá Sản Phẩm',
            'price.max' => 'Hãy Nhập Giá Sản Phẩm Dưới 20 Ký Tự',
            'describe.required' => 'Hãy Nhập Mô Tả Sản Phẩm',
            'configuration.required' => 'Hãy Nhập Cấu Hình Sản Phẩm',
            'quantity.required' => 'Hãy Nhập Số Lượng Sản Phẩm',
            'quantity.max' => 'Hãy Nhập Số Lượng Sản Phẩm Dưới 20 Ký Tự',
            'specifications.required' => 'Hãy Nhập Thông Số Kỹ Thuật Sản Phẩm',
            'inputFile.required' => 'Hãy Nhập Ảnh Sản Phẩm',
            'color.required' => 'Hãy Nhập Màu Sản Phẩm',
            'price_product.required' => 'Hãy Nhập Giá Theo Cấu Hình Sản Phẩm'
        ];
        return $messages;
    }
}
