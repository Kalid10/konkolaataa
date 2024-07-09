<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActiveSubscriber(): bool
    {
        return $this->subscription_ends_at && $this->subscription_ends_at->gt(Carbon::today());
    }

    public function isActiveOnetimePlanSubscriber(): bool
    {
        return $this->onetime_plan_ends_at && $this->onetime_plan_ends_at->gt(Carbon::today());
    }

    protected $casts = [
        'subscription_ends_at' => 'date',
        'onetime_plan_ends_at' => 'date',
    ];
}
