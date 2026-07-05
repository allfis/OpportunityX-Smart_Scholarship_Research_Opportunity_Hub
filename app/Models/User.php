<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $hidden = ['password_hash', 'remember_token'];
    protected $fillable = [
        'name', 'email', 'password_hash', 'role', 'university_id',
        'department', 'education_level', 'cgpa', 'fields_of_interest',
        'profile_photo', 'bio', 'research_experience_years',
        'country_id', 'is_verified',
    ];
    protected $casts = [
        'cgpa' => 'decimal:2',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'research_experience_years' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPasswordName()
    {
        return 'password_hash';
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function postedOpportunities()
    {
        return $this->hasMany(Opportunity::class, 'posted_by');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function activityLog()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function isFaculty(): bool
    {
        return in_array($this->role, ['faculty', 'admin']);
    }
}