<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name' => 'required| min: 2| max: 255',
            'price' => 'required| numeric| min: 0| max: 9999,99',
            'course' => 'nullable| max: 20',
            'ingredients' => 'required| max: 2000',
            'available' => 'required| min: 0| max: 1| numeric',
            'is_vegan' => 'nullable| min: 1| max: 1| numeric',
            'is_veggy' => 'nullable| min: 1| max: 1| numeric',
            'is_hot' => 'nullable| min: 1| max: 1| numeric',
            'is_lactose_free' => 'nullable| min: 1| max: 1| numeric',
            'is_gluten_free' => 'nullable| min: 1| max: 1| numeric'
        ];
    }
}
