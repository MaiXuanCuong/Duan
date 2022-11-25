<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassWordByMailRequest extends FormRequest
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
            'emails' => 'required|email',
           ];
            return $rules;
    }
        public function messages(){
            $messages =[
                'emails.required' => 'Hãy Nhập Email Của Bạn',
                'emails.email' => 'Email Chưa Đúng Định Dạng',
            ];
            return $messages;
        }
}
