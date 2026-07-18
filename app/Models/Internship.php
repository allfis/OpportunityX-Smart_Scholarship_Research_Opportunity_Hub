<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'company_name', 'is_paid', 'stipend_amount',
        'stipend_currency', 'duration_months', 'remote_allowed', 'location', 'required_skills',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'stipend_amount' => 'decimal:2',
        'remote_allowed' => 'boolean',
        'required_skills' => 'array',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}