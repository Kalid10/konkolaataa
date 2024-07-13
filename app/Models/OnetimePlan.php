<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnetimePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'currency',
        'validity_days',
        'max_posts',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function onetime(): HasMany
    {
        return $this->hasMany(Onetime::class);
    }
}
