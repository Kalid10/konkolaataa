<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCarRequest;
use App\Models\Car;
use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarConditionType;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Color;
use App\Models\EngineType;
use App\Models\FuelType;
use App\Models\Image;
use App\Services\UploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function store(PostCarRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();

            $car = Car::create([
                'car_model_id' => $request->carModelId,
                'year' => $request->year,
                'exterior_color_id' => $request->exteriorColorId,
                'interior_color_id' => $request->interiorColorId,
                'is_original_paint' => $request->isOriginalPaint,
                'accident_severity' => $request->severityOfAccident,
                'plate_type' => $request->carPlateType,
                'transmission_type' => $request->transmissionType,
                'mileage' => $request->mileage,
                'seller_type' => $request->sellerType,
                'percentage' => $request->percentage,
                'price' => $request->price,
                'price_type' => $request->priceType,
                'car_condition_type_id' => $request->carConditionTypeId,
                'fuel_type_id' => $request->fuelTypeId,
                'engine_type_id' => $request->engineTypeId,
                'car_body_type_id' => $request->carBodyTypeId,
                'city_id' => $request->cityId,
                'description' => $request->description,
                'google_map_location' => $request->googleMapLocation,
                'location' => $request->location,
                'status' => 'pending',
                'posted_at' => now(),
                'post_expires_at' => now()->addDays(30),
                'user_id' => $user->id,
            ]);

            Log::info('Car created successfully' , $car->toArray());

            // Merge the two arrays
            $carImages = array_merge($request->exteriorCarImages, $request->interiorCarImages);
            $this->uploadCarImages($carImages, $car);

            DB::commit();
            return redirect()->back()->with('success', 'Car posted successfully.');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Error posting car: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Error posting car.');
        }
    }

    public function uploadCarImages($images ,$car) {
        $user = auth()->user();

        foreach ($images as $image) {
            $filename = $user->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            try {
                $uploaded_url = UploadService::uploadImage( UploadService::resize($image->getRealPath(), 500, 500), $filename, 'cars/');
                Image::create([
                    'imageable_id' => $car->id,
                    'imageable_type' => Car::class,
                    'url' => $uploaded_url,
                    'name' => $filename,
                ]);
            } catch (\Exception $exception) {
                Log::error('Upload failed: ' . $exception->getMessage());
            }
        }
    }
}
