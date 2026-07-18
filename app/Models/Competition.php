<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'competition_type', 'team_size_min', 'team_size_max',
        'prizes', 'rounds', 'requires_registration_fee', 'registration_fee_amount',
    ];

    protected $casts = [
        'prizes' => 'array',
        'requires_registration_fee' => 'boolean',
        'registration_fee_amount' => 'decimal:2',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}