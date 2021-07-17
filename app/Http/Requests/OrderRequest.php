<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'name' => 'required|string| min: 2| max: 255',
            'last_name' => 'required|string| min: 2| max: 255',
            'email' =>'required| email| string | max: 255',
            'delivery_address'=> 'required| string |min: 5| max: 255',
        ];
    }
}
