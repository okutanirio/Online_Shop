<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $ret = [
            'name'          => 'required', 
            'email'         => 'required', 
            'message'       => 'required', 
        ];
        return $ret;
    }

    public function attributes()
    {
        return [
            'name'          => 'お名前', 
            'email'         => 'メールアドレス', 
            'message'       => 'お問い合わせ内容', 
        ];
    }
}
