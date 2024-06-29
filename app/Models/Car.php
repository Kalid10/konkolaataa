<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    public function exteriorColor(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function interiorColor(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
