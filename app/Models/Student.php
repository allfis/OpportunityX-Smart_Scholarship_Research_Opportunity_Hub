<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'university', 'department', 'cgpa', 'gpa_scale',
        'current_semester', 'skills', 'research_interests', 'achievements',
        'resume_path', 'profile_picture_path', 'bio', 'phone',
        'date_of_birth', 'address', 'profile_completion_percentage',
    ];

    protected $casts = [
        'skills' => 'array',
        'research_interests' => 'array',
        'achievements' => 'array',
        'cgpa' => 'decimal:2',
        'gpa_scale' => 'decimal:1',
        'date_of_birth' => 'date',
        'profile_completion_percentage' => 'integer',
    ];

    // Inverse one-to-one: Student belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // One-to-many: A student has many applications
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    // One-to-many: A student has many bookmarks
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    // Many-to-many: A student bookmarks many opportunities (through bookmarks table)
    public function bookmarkedOpportunities(): BelongsToMany
    {
        return $this->belongsToMany(Opportunity::class, 'bookmarks')
            ->withTimestamps();
    }
}