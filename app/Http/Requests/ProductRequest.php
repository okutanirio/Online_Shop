<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $ret = [];
        if (!isset($this->image_delete)) {
            $ret = [
                'name'          => 'required', 
                'price'         => 'required|integer', 
                'stock'         => 'required|integer', 
                'type_id'       => 'required', 
                'info'          => 'required', 
                'description'   => 'required', 
                'image'         => 'required', 
            ];
        }
        return $ret;
    }
}
