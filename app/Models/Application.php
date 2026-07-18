<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id', 'student_id', 'status', 'cover_letter', 'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        // Auto-set applied_at when creating
        static::creating(function (Application $application) {
            $application->applied_at = $application->applied_at ?? now();
        });
    }

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // One-to-many: An application has many status logs
    public function statusLogs(): HasMany
    {
        return $this->hasMany(ApplicationStatusLog::class);
    }

    // Helper: Status label with color
    public function statusBadge(): string
    {
        return match($this->status) {
            'applied' => 'badge-blue',
            'under_review' => 'badge-yellow',
            'shortlisted' => 'badge-purple',
            'accepted' => 'badge-green',
            'rejected' => 'badge-red',
            'withdrawn' => 'badge-red',
            default => 'badge-blue',
        };
    }

    public function statusLabel(): string
    {
        return str_replace('_', ' ', ucfirst($this->status));
    }
}