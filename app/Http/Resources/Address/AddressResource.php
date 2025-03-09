<?php

namespace App\Http\Resources\Address;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Address */
class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'district' => $this->district,
            'state' => $this->state,
            'landmark' => $this->landmark,
            'pin' => $this->pin,
            'contact_number_country_code' => $this->contact_number_country_code,
            'contact_number' => $this->contact_number,
            'is_default' => $this->is_default,
        ];
    }
}
