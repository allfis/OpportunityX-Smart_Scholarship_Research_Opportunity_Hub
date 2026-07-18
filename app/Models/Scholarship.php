<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'scholarship_type', 'min_cgpa',
        'required_departments', 'gpa_scale', 'covers_tuition',
        'covers_living', 'covers_travel', 'covers_insurance', 'additional_benefits',
    ];

    protected $casts = [
        'min_cgpa' => 'decimal:2',
        'gpa_scale' => 'decimal:1',
        'required_departments' => 'array',
        'covers_tuition' => 'boolean',
        'covers_living' => 'boolean',
        'covers_travel' => 'boolean',
        'covers_insurance' => 'boolean',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}