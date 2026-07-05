<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Opportunity extends Model
{
    protected $fillable = [
        'type_id', 'title', 'description', 'organization', 'field_id',
        'country_id', 'amount', 'deadline', 'eligibility_criteria',
        'application_url', 'posted_by', 'is_featured', 'is_active',
        'views_count', 'applications_count',
    ];
    protected $casts = [
        'deadline' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'applications_count' => 'integer',
    ];

    public function type()
    {
        return $this->belongsTo(OpportunityType::class, 'type_id');
    }

    public function field()
    {
        return $this->belongsTo(FieldOfStudy::class, 'field_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getDaysRemainingAttribute(): int
    {
        return max(0, now()->diffInDays($this->deadline));
    }

    public function getDeadlineStatusAttribute(): string
    {
        $days = $this->days_remaining;
        if ($days <= 7) return 'urgent';
        if ($days <= 30) return 'soon';
        return 'normal';
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', 1)->where('deadline', '>', now());
    }

    public function scopeFeatured(Builder $q): Builder
    {
        return $q->where('is_featured', 1);
    }

    public function scopeOfType(Builder $q, string $slug): Builder
    {
        return $q->whereHas('type', fn($q) => $q->where('slug', $slug));
    }

    public function scopeSearch(Builder $q, string $term): Builder
    {
        return $q->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('organization', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }
}