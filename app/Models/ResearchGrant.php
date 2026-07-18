<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchGrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'research_area', 'grant_type', 'max_funding',
        'min_duration_months', 'max_duration_months', 'requires_proposal', 'requires_supervisor',
    ];

    protected $casts = [
        'max_funding' => 'decimal:2',
        'requires_proposal' => 'boolean',
        'requires_supervisor' => 'boolean',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}