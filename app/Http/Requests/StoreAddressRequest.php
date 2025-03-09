<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'pin' => 'required|integer',
            'district' => 'required',
            'state' => 'required',
            'landmark' => 'nullable',
            'contact_number_country_code' => 'required',
            'contact_number' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'pin.integer' => 'Enter valid PIN.',
        ];
    }
}
