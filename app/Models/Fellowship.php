<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fellowship extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'fellowship_provider', 'duration_months',
        'includes_stipend', 'includes_research_funding', 'includes_mentorship', 'requires_publication',
    ];

    protected $casts = [
        'includes_stipend' => 'boolean',
        'includes_research_funding' => 'boolean',
        'includes_mentorship' => 'boolean',
        'requires_publication' => 'boolean',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}