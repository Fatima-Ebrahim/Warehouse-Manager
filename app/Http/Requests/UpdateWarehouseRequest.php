<?php

namespace App\Http\Requests;

use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWarehouseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'code' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('warehouses')->ignore($this->warehouse)
            ],
            'location' => 'nullable|string|max:255',
            'type' => ['sometimes', Rule::in(array_keys(Warehouse::TYPES))],
            'temperature' => 'nullable|numeric|between:-50,50',
            'humidity' => 'nullable|numeric|between:0,100',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ];
    }
}
