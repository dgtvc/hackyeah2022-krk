<?php

namespace App\Http\Requests;

use App\Traits\RequestDefaultValuesTrait;
use Illuminate\Foundation\Http\FormRequest;

class FetchLocationRequest extends FormRequest
{
    use RequestDefaultValuesTrait;

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
            'trashType' => [
                'array',
            ],
            'trashType.*' => [
                'uuid',
            ],
            'recycleType' => [
                'array',
            ],
            'recycleType.*' => [
                'uuid',
            ],
            'distance' => [
                'integer',
                'max:500',
                'min:1',
            ],
            'lat' => [
                'required',
                'between:-90,90',
            ],
            'lng' => [
                'required',
                'between:-180,180',
            ]
        ];
    }
}
