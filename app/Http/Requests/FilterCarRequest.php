<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'filters' => 'nullable|array',
            'carConditionType' => 'nullable|exists:car_condition_types,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
