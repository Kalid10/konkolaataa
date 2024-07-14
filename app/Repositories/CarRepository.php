<?php

namespace App\Repositories;

use App\Models\Car;
use AWS\CRT\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class CarRepository
{
    public function getAllCarsWithRelations($filters, $search, $conditionTypes): LengthAwarePaginator|array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_Car_C
    {
        $query = Car::whereIn('car_condition_type_id', $conditionTypes)
            ->where(function ($query) use ($search) {
                $query->whereRelation('carModel.carBrand', 'name', 'LIKE', $search)
                    ->orWhereRelation('carModel', 'name', 'LIKE', $search);
            });

        $filterMapping = [
            'sellerType' => 'seller_type',
            'transmissionType' => 'transmission_type',
            'location' => 'city'
        ];
        if ($filters) {
            foreach ($filters as $filterCategory => $filterValues) {
                switch ($filterCategory) {
                    case 'sellerType':
                    case 'transmissionType':
                        $column = $filterMapping[$filterCategory];
                        $query->whereIn($column, array_column($filterValues, 'name'));
                        break;

                    case 'plateType':
                        $query->whereIn('plate_type', array_column($filterValues, 'value'));
                        break;

                    case 'carBrands':
                        $query->whereHas('carModel.carBrand', function ($query) use ($filterValues) {
                            $query->whereIn('id', array_column($filterValues, 'id'));
                        });
                        break;

                    case 'year':
                    case 'mileage':
                    case 'price':
                        $from = $filterValues['from'];
                        $to = $filterValues['to'];
                        if ($from && $to) {
                            $query->whereBetween($filterCategory, [$from, $to]);
                        } elseif ($from) {
                            $query->where($filterCategory, '>=', $from);
                        } elseif ($to) {
                            $query->where($filterCategory, '<=', $to);
                        }
                        break;
                    default:
                        if ($filterCategory === 'location') {
                            $filterCategory = 'city';
                        }
                        $query->whereHas($filterCategory, function ($query) use ($filterValues) {
                            $query->whereIn('id', array_column($filterValues, 'id'));
                        });
                        break;
                }
            }
        }
        return $query->with([
            'carModel.carBrand', 'exteriorColor', 'interiorColor', 'carBodyType',
            'engineType', 'fuelType', 'city', 'carConditionType', 'images', 'user'
        ])->latest()->paginate(10);
    }

    public function getCarWithRelations(int $carId): Model|\Illuminate\Database\Eloquent\Collection|array|\Illuminate\Database\Eloquent\Builder|Car|\LaravelIdea\Helper\App\Models\_IH_Car_QB|\LaravelIdea\Helper\App\Models\_IH_Car_C|null
    {
        return Car::with([
            'carModel.carBrand', 'exteriorColor', 'interiorColor', 'carBodyType',
            'engineType', 'fuelType', 'city', 'carConditionType', 'user', 'images'
        ])->findOrFail($carId);
    }

    public function storeOrUpdateCar(array $data): Car
    {
        return Car::updateOrCreate(['id' => $data['car_id']], $data);
    }

    public function getCarsByUserId(int $userId): LengthAwarePaginator|array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_Car_C
    {
        return Car::where('user_id', $userId)->with([
            'carModel.carBrand', 'exteriorColor', 'interiorColor', 'carBodyType',
            'engineType', 'fuelType', 'city', 'carConditionType', 'images'
        ])->paginate(10);
    }
}
