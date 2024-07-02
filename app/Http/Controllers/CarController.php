<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
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
        return Inertia::render('Car/Create',[
            'carBrands' => $carBrands,
        ]);
    }
}
