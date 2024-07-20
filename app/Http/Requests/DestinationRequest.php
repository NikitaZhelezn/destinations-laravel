<?php

namespace App\Http\Requests;

use App\Models\Destination;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
{
    public Destination $destination;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destination_name' => [
                'required',
                'string',function ($attribute, $value, $fail) {
                    if (! $value) {
                        $fail(__('Destination not found.'));

                        return;
                    }

                    $destination = Destination::where('name', $value)
                        ->first();

                    if (! $destination) {
                        $fail(__('Destination not found.'));

                        return;
                    }

                    $this->destination = $destination;
                },
            ],
            'radius' => [
                'required',
                'numeric',
                'min:0.01',
                'max:29999.99'
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
