<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'category_id', 'country_id',
        'posted_by', 'type', 'status', 'deadline', 'funding_amount',
        'funding_currency', 'funding_type', 'degree_level',
        'eligibility_criteria', 'apply_url', 'is_featured', 'views_count',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'funding_amount' => 'decimal:2',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'eligibility_criteria' => 'array',
    ];

    // Auto-generate slug when creating
    protected static function booted(): void
    {
        static::creating(function (Opportunity $opportunity) {
            if (empty($opportunity->slug)) {
                $opportunity->slug = Str::slug($opportunity->title) . '-' . Str::random(6);
            }
        });
    }

    // Belongs to category (subject area like CS, Engineering)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Belongs to country
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    // Belongs to the user (faculty) who posted it
    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    // Polymorphic-style: one-to-one with type-specific detail table
    public function scholarship(): HasOne
    {
        return $this->hasOne(Scholarship::class);
    }

    public function researchGrant(): HasOne
    {
        return $this->hasOne(ResearchGrant::class);
    }

    public function internship(): HasOne
    {
        return $this->hasOne(Internship::class);
    }

    public function fellowship(): HasOne
    {
        return $this->hasOne(Fellowship::class);
    }

    public function competition(): HasOne
    {
        return $this->hasOne(Competition::class);
    }

    // Get the type-specific detail dynamically
    public function typeDetail(): HasOne
    {
        return match($this->type) {
            'scholarship' => $this->scholarship(),
            'research_grant' => $this->researchGrant(),
            'internship' => $this->internship(),
            'fellowship' => $this->fellowship(),
            'competition' => $this->competition(),
            default => $this->scholarship(),
        };
    }

    // One-to-many: An opportunity has many applications
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    // Many-to-many: An opportunity is bookmarked by many students
    public function bookmarkedBy(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'bookmarks')
            ->withTimestamps();
    }

    // Helper: Check if deadline is approaching (within 7 days)
    public function isDeadlineApproaching(): bool
    {
        if (!$this->deadline) return false;
        return $this->deadline->isFuture() && $this->deadline->diffInDays(now()) <= 7;
    }

    // Helper: Check if deadline has passed
    public function isExpired(): bool
    {
        if (!$this->deadline) return false;
        return $this->deadline->isPast();
    }

    // Helper: Format funding amount
    public function formattedFunding(): string
    {
        if (!$this->funding_amount) {
            return $this->funding_type === 'none' ? 'Unfunded' : 'Not specified';
        }
        return $this->funding_currency . ' ' . number_format($this->funding_amount, 0);
    }

    // Helper: Get type label for display
    public function typeLabel(): string
    {
        return match($this->type) {
            'scholarship' => 'Scholarship',
            'research_grant' => 'Research Grant',
            'internship' => 'Internship',
            'fellowship' => 'Fellowship',
            'competition' => 'Competition',
            default => 'Opportunity',
        };
    }

    // Helper: Get type color for badges
    public function typeColor(): string
    {
        return match($this->type) {
            'scholarship' => 'blue',
            'research_grant' => 'green',
            'internship' => 'purple',
            'fellowship' => 'yellow',
            'competition' => 'red',
            default => 'blue',
        };
    }

    // Scope: Only active opportunities
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope: By type
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // Scope: Featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope: Not expired
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('deadline')
              ->orWhere('deadline', '>', now());
        });
    }

    // Scope: Search by title or description
    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'LIKE', "%{$term}%")
              ->orWhere('description', 'LIKE', "%{$term}%");
        });
    }
}