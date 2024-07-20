<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
            ],
            'lat' => [
                'nullable',
                'numeric',
                'max:9999.999'
            ],
            'lon' => [
                'nullable',
                'numeric',
                'max:9999.999'
            ],
            'offset' => [
                'nullable',
                'integer',
                'min:0',
                'max:15'
            ],
            'limit' => [
                'nullable',
                'integer',
                'min:5',
                'max:40'
            ],
        ];
    }
}
