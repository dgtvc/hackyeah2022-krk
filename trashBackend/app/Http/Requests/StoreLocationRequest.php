<?php

namespace App\Http\Requests;

use App\Models\RecycleType;
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
            'address' => [
                'required',
                'max:160'
            ],
            'title' => [
                'required',
                'max:160'
            ],
            'description' => [
                'required',
                'max:99999'
            ],
            'lat' => [
                'required',
                'between:-90,90',
            ],
            'lng' => [
                'required',
                'between:-180,180'
            ],
            'category' => [
                'array',
            ],
            'category.*' => [
                'uuid',
                'exists:categories,uuid',
            ],
            RecycleType::RELATION_STRING => [
                'required',
                'uuid',
                'exists:recycle_types,uuid',
            ]
        ];
    }
}
