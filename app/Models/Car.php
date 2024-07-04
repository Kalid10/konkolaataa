<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function exteriorColor(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function interiorColor(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function carBodyType(): BelongsTo
    {
        return $this->belongsTo(CarBodyType::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function engineType(): BelongsTo
    {
        return $this->belongsTo(EngineType::class);
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function carConditionType(): BelongsTo
    {
        return $this->belongsTo(CarConditionType::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
