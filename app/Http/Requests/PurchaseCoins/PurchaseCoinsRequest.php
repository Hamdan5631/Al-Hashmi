<?php

namespace App\Http\Requests\PurchaseCoins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PurchaseCoinsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'coins' => 'required|integer',
        ];
    }
}
