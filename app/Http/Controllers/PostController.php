<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $carBrands = CarBrand::all();
        return Inertia::render('Post/Index',[
            'carBrands' => $carBrands,
        ]);
    }
}
