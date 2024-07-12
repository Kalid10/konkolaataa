<?php
namespace App\Services;

use App\Models\Car;
use App\Models\Image;
use App\Repositories\CarRepository;
use App\Services\UploadService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelIdea\Helper\App\Models\_IH_Car_C;
use LaravelIdea\Helper\App\Models\_IH_Car_QB;

class CarService
{
    protected CarRepository $carRepository;
    protected \App\Services\UploadService $uploadService;

    public function __construct(CarRepository $carRepository, UploadService $uploadService)
    {
        $this->carRepository = $carRepository;
        $this->uploadService = $uploadService;
    }

    public function getAllCarsWithFilters($filters, $search, $conditionTypes): LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array|_IH_Car_C
    {
        return $this->carRepository->getAllCarsWithRelations($filters, $search, $conditionTypes);
    }

    public function getCarDetails(int $carId): Model|Collection|Builder|array|Car|_IH_Car_QB|_IH_Car_C|null
    {
        return $this->carRepository->getCarWithRelations($carId);
    }

    public function createOrUpdateCar(array $data, array $carImages): array
    {
        DB::beginTransaction();
        try {
            $car = $this->carRepository->storeOrUpdateCar($data);
            $this->uploadCarImages($carImages, $car);
            DB::commit();
            return ['success' => true, 'message' => $data['carId'] ? 'Car updated successfully' : 'Car posted successfully.'];
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Error posting car: ' . $exception->getMessage());
            return ['success' => false, 'message' => 'Error posting car.'];
        }
    }

    public function getUserCars(int $userId): LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|array|_IH_Car_C
    {
        return $this->carRepository->getCarsByUserId($userId);
    }

    private function uploadCarImages($images, $car)
    {
        foreach ($images as $image) {
            $filename = auth()->id() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            try {
                $uploaded_url = $this->uploadService->uploadImage($this->uploadService->resize($image->getRealPath(), 1000, 1000), $filename, 'cars/');
                Image::create([
                    'imageable_id' => $car->id,
                    'imageable_type' => Car::class,
                    'url' => $uploaded_url,
                    'name' => $filename,
                ]);
            } catch (Exception $exception) {
                Log::error('Upload failed: ' . $exception->getMessage());
            }
        }
    }
}