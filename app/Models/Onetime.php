<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Onetime extends Model
{
    use HasFactory;

    protected $table = 'onetime';

    protected $fillable = [
        'seller_id',
        'onetime_plan_id',
        'tx_ref',
        'status',
        'expires_at',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function onetimePlan(): BelongsTo
    {
        return $this->belongsTo(OnetimePlan::class);
    }
}
