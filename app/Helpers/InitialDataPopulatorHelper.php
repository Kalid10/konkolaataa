<?php
namespace App\Helpers;

use App\Models\CarConditionType;
use App\Models\City;
use App\Models\Color;
use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\EngineType;
use App\Models\FuelType;

class InitialDataPopulatorHelper
{
    public static function createColors(): void
    {
        $colors = [
            'Black' => '#000000',
            'White' => '#FFFFFF',
            'Red' => '#FF0000',
            'Green' => '#00FF00',
            'Blue' => '#0000FF',
            'Yellow' => '#FFFF00',
            'Cyan' => '#00FFFF',
            'Magenta' => '#FF00FF',
            'Silver' => '#C0C0C0',
            'Gray' => '#808080',
            'Maroon' => '#800000',
            'Olive' => '#808000',
            'Lime' => '#00FF00',
            'Teal' => '#008080',
            'Navy' => '#000080',
            'Purple' => '#800080',
            'Orange' => '#FFA500',
            'Brown' => '#A52A2A',
        ];

        foreach ($colors as $name => $hex) {
            Color::create([
                'name' => $name,
                'hex' => $hex,
            ]);
        }
    }

    public static function generateCarBodyTypes(): void
    {
        $carBodyTypes = [
            'Sedan',
            'Hatchback',
            'SUV',
            'Crossover',
            'Coupe',
            'Convertible',
            'Wagon',
            'Van',
            'Truck',
        ];

        foreach ($carBodyTypes as $carBodyType) {
            CarBodyType::create([
                'name' => $carBodyType,
            ]);
        }
    }

    public static function generateCarBrandsAndModels(): void
    {
        $carBrands = [
            'Audi' => ['A3', 'A4', 'Q5', 'Q7'],
            'BMW' => ['X1', 'X3', 'X5', '3 Series'],
            'Chevrolet' => ['Spark', 'Malibu', 'Tahoe', 'Silverado'],
            'Ford' => ['Fiesta', 'Focus', 'Mustang', 'Explorer'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe'],
            'Kia' => ['Rio', 'Forte', 'Sorento', 'Sportage'],
            'Mazda' => ['Mazda3', 'Mazda6', 'CX-5', 'CX-9'],
            'Mercedes-Benz' => ['A-Class', 'C-Class', 'E-Class', 'GLC'],
            'Nissan' => ['Sentra', 'Altima', 'Rogue', 'Pathfinder'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Highlander'],
            'Volkswagen' => ['Golf', 'Passat', 'Tiguan', 'Atlas'],
            'Suzuki' => ['Dzire', 'Swift', 'Baleno', 'Vitara'],
        ];

        foreach ($carBrands as $brandName => $models) {
            $carBrand = CarBrand::create(['name' => $brandName]);

            foreach ($models as $modelName) {
                CarModel::create([
                    'name' => $modelName,
                    'car_brand_id' => $carBrand->id,
                ]);
            }
        }
    }

    public static function generateEngineTypes(): void
    {
        $engineTypes = [
            '1.0L',
            '1.2L',
            '1.4L',
            '1.6L',
            '1.8L',
            '2.0L',
            '2.2L',
            '2.4L',
            '2.6L',
            '2.8L',
            '3.0L',
            '3.2L',
            '3.4L',
            '3.6L',
            '3.8L',
            '4.0L',
            '4.2L',
            '4.4L',
            '4.6L',
            '4.8L',
            '5.0L',
        ];

        foreach ($engineTypes as $engineType) {
            EngineType::create([
                'name' => $engineType,
            ]);
        }
    }

    public static function generateCarConditionTypes (): void
    {
        $carConditionTypes = [
            'brand_new',
            'used_in_ethiopia',
            'used'
        ];

        foreach ($carConditionTypes as $carConditionType) {
            CarConditionType::create([
                'name' => $carConditionType,
            ]);
        }
    }

    public static function generateFuelTypes(): void
    {
        $fuelTypes = [
            'petrol',
            'diesel',
            'electric',
            'hybrid',
        ];

        foreach ($fuelTypes as $fuelType) {
            FuelType::create([
                'name' => $fuelType,
            ]);
        }
    }

    public static function generateCities(): void
    {
         $cities = [
            'AddisAbaba',
            'DireDawa',
            'Mekelle',
            'Gondar',
            'Adama',
            'Hawassa',
            'Jimma',
            'BahirDar',
            'Dessie',
            'Jijiga'
             ];

        foreach ($cities as $item) {
            City::create([
                'name' => $item,
            ]);
         }

    }
}
