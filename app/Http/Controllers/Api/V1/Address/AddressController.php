<?php

namespace App\Http\Controllers\Api\V1\Address;

use App\Actions\Address\StoreAddressAction;
use App\Actions\Address\UpdateAddressAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\Address\AddressCollection;
use App\Http\Resources\Address\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AddressController extends Controller
{
    public function index(): AddressCollection
    {
        $address = Address::query()->where('user_id', Auth::id())->get();

        return new AddressCollection($address);
    }

    /**
     * @throws Throwable
     */
    public function store(StoreAddressRequest $request, StoreAddressAction $action): JsonResponse
    {
        $response = $action->execute(collect($request));

        $data = new AddressResource($response);

        return $this->jsonResponse('Address added successfully', $data, 200);
    }

    public function show($id): JsonResponse|AddressResource
    {
        $address = Address::query()->where('user_id', Auth::id())->find($id);

        if (!$address) {
            return $this->jsonResponse('No address found', 404);
        }
        return new AddressResource($address);
    }

    /**
     * @throws Throwable
     */
    public function update(StoreAddressRequest $request, Address $address, UpdateAddressAction $action): JsonResponse
    {
        $address = Address::query()->find($address->id);

        $response = $action->execute(collect($request), $address);

        $data = new AddressResource($response);

        return $this->jsonResponse('Address updated successfully', $data, 200);
    }

    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return $this->jsonResponse('Address deleted successfully', null, 200);
    }
}
