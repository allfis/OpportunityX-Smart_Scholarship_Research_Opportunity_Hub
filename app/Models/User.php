<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // One-to-one: A user can have one student profile
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    // One-to-one: A user can have one faculty profile
    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class);
    }

    // One-to-many: A faculty user posts many opportunities
    public function postedOpportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class, 'posted_by');
    }

    // One-to-many: A user can change many application statuses (as changed_by)
    public function statusChanges(): HasMany
    {
        return $this->hasMany(ApplicationStatusLog::class, 'changed_by');
    }

    // Check role helper methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isFaculty(): bool
    {
        return $this->role === 'faculty';
    }
}