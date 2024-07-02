<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'carBrandId' => 'required|exists:car_brands,id',
            'carModelId' => 'required|exists:car_models,id',
            'carConditionTypeId' => 'required|exists:car_condition_types,id',
            'carBodyTypeId' => 'required|exists:car_body_types,id',
            'engineTypeId' => 'required|exists:engine_types,id',
            'fuelTypeId' => 'required|exists:fuel_types,id',
            'year' => 'required|integer|min:1900|max:2024',
            'price' => 'required|numeric|min:0',
            'priceType' => 'required|in:fixed,negotiable,slightly_negotiable',
            'mileage' => 'required|integer|min:0',
            'cityId' => 'required|exists:cities,id',
            'description' => 'required|string',
//            'images' => 'required|array',
//            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'exteriorColorId' => 'required|exists:colors,id',
            'interiorColorId' => 'required|exists:colors,id',
            'transmissionType' => 'required|in:automatic,manual,semi_automatic',
            'carPlateType' => 'required|in:1,2,3',
            'sellerType' => 'required|in:private,broker',
            'percentage' => 'required|numeric|min:0|max:10',
            'isOriginalPaint' => 'required|boolean',
            'severityOfAccident' => 'required|in:minor,moderate,severe',
            'googleMapLocation' => 'nullable|string',
            'location' => 'nullable|string',


        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
