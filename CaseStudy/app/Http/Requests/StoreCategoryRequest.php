<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            //
            $rules = [
                    'name' => 'required|min:3|unique:categories'
            ];
            return $rules;
        }
    public function messages(){

        $messages = [
            'name.min' => 'Tên phải Lớn hơn 3 ký tự',
            'name.required' => 'Hãy Nhập Tên Danh Mục!',
            'name.unique' => 'Tên Danh Mục Đã Tồn Tại'
        ];
        return $messages;
    }
}
