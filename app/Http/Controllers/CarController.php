<?php

namespace App\Http\Controllers;

use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarConditionType;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Color;
use App\Models\EngineType;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index()
    {
        return Inertia::render('Car/Index');
    }

    public function show()
    {
        return Inertia::render('Car/Show');
    }

    public function create()
    {
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        $carBodyTypes = CarBodyType::all();
        $colors = Color::all();
        $engineTypes = EngineType::all();
        $fuelTypes = FuelType::all();
        $cities = City::all();
        $carConditionTypes = CarConditionType::all();

        return Inertia::render('Car/Create',[
            'carBrands' => $carBrands,
            'carModels' => $carModels,
            'carBodyTypes' => $carBodyTypes,
            'colors' => $colors,
            'engineTypes' => $engineTypes,
            'fuelTypes' => $fuelTypes,
            'cities' => $cities,
            'carConditionTypes' => $carConditionTypes,
        ]);
    }
}
