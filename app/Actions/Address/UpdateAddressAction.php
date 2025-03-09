<?php

namespace App\Actions\Address;

use App\Models\Address;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateAddressAction
{
    /**
     * @throws \Throwable
     */
    public function execute(Collection $data, Address $address): Address
    {
        DB::beginTransaction();

        $address->user_id = Auth::id();
        $address->name = $data->get('name');
        $address->address_line_1 = $data->get('address_line_1');
        $address->address_line_2 = $data->get('address_line_2');
        $address->pin = $data->get('pin');
        $address->district = $data->get('district');
        $address->state = $data->get('state');
        $address->landmark = $data->get('landmark');
        $address->contact_number_country_code = $data->get('contact_number_country_code');
        $address->contact_number = $data->get('contact_number');
        $address->save();

        DB::commit();

        return $address;
    }
}
