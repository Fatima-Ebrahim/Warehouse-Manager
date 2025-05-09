<?php

namespace App\Http\Requests;

use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWarehouseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:warehouses',
            'location' => 'nullable|string|max:255',
            'type' => ['required', Rule::in(array_keys(Warehouse::TYPES))],
            'temperature' => 'nullable|numeric|between:-50,50',
            'humidity' => 'nullable|numeric|between:0,100',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'نوع المستودع يجب أن يكون واحدًا من: ' . implode(', ', Warehouse::TYPES),
        ];
    }
}
