<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
        return [
            'name' => 'required|max:80',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'category' => 'array',
            'category.*' => 'uuid|exists:categories,uuid',
//            'recycle_type' => 'string|exists:recycle_type,uuid'
        ];
    }
}
