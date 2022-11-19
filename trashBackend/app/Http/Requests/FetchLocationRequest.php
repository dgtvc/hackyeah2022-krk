<?php

namespace App\Http\Requests;

use App\DataTransferObject\FetchQueryDto;
use App\Models\RecycleType;
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
                'required',
            ],
            'recycleType' => [
                'required'
            ],
            'distance' => [
                'required'
            ],
            'latitude' => [
                'required'
            ],
            'longitude' => [
                'required'
            ],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        return new FetchQueryDto(
            $data['trashType'],
            $data['recycleType'],
            $data['distance'],
            $data['latitude'],
            $data['longitude'],
        );
    }
}
