<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'university', 'department', 'designation',
        'bio', 'profile_picture_path', 'specialization', 'website_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // One-to-many: A faculty posts many opportunities
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class, 'posted_by', 'user_id');
    }
}