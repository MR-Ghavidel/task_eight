<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'broker_id' => 'required|integer|exists:brokers,id',
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string',
            'area' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'sale_type' => 'required',
            'type' => 'required',
            'city' => 'required|string|min:3',
            'street' => 'required|string|min:3',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'floor' => 'required|integer|min:0',
            'total_floors' => 'required|integer|min:0',
            'features' => 'required|array',
            'features.*' => 'required|string|min:3',
        ];
    }
}
