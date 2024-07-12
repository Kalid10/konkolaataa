<?php
namespace App\Http\Controllers;

use App\Http\Requests\FilterCarRequest;
use App\Http\Requests\PostCarRequest;
use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarConditionType;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Color;
use App\Models\EngineType;
use App\Models\FuelType;
use App\Services\CarService;
use Inertia\Inertia;

class CarController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(FilterCarRequest $request)
    {
        $filters = $request->filters;
        $search = '%' . $request->search . '%';
        $conditionTypes = $request->carConditionType ? [$request->carConditionType] : CarConditionType::all()->pluck('id')->toArray();

        $cars = $this->carService->getAllCarsWithFilters($filters, $search, $conditionTypes);

        return Inertia::render('Car/Index', [
            'cars' => $cars,
            'carBrands' => CarBrand::all(),
            'carModels' => CarModel::all(),
            'carBodyTypes' => CarBodyType::all(),
            'colors' => Color::all(),
            'engineTypes' => EngineType::all(),
            'fuelTypes' => FuelType::all(),
            'cities' => City::all(),
            'carConditionTypes' => CarConditionType::all(),
            'search' => $request->search ?? '',
            'filters' => $request->filters ?? [
                    'sellerType' => [], 'carConditionType' => [], 'transmissionType' => [],
                    'carBrands' => [], 'year' => ['from' => null, 'to' => null], 'mileage' => ['from' => null, 'to' => null],
                    'price' => ['from' => null, 'to' => null], 'fuelType' => [], 'exteriorColor' => [],
                ],
        ]);
    }

    public function show($carId)
    {
        $car = $this->carService->getCarDetails($carId);
        return Inertia::render('Car/Show', ['car' => $car]);
    }

    public function create()
    {
        return Inertia::render('Car/Create', [
            'carBrands' => CarBrand::all(),
            'carModels' => CarModel::all(),
            'carBodyTypes' => CarBodyType::all(),
            'colors' => Color::all(),
            'engineTypes' => EngineType::all(),
            'fuelTypes' => FuelType::all(),
            'cities' => City::all(),
            'carConditionTypes' => CarConditionType::all(),
        ]);
    }

    public function store(PostCarRequest $request)
    {
        $data = $request->validated();
        $carImages = array_merge($request->exteriorCarImages, $request->interiorCarImages);
        $result = $this->carService->createOrUpdateCar($data, $carImages);

        return redirect()->back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function userCars()
    {
        $cars = $this->carService->getUserCars(auth()->id());
        return Inertia::render('Car/UserCars', ['cars' => $cars]);
    }
}
