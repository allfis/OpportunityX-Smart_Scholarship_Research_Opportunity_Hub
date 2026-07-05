<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'opportunity_id', 'status_id', 'applied_date', 'notes'];
    protected $casts = ['applied_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function status()
    {
        return $this->belongsTo(ApplicationStatus::class, 'status_id');
    }

    protected static function booted()
    {
        static::created(function ($app) {
            $app->opportunity?->increment('applications_count');
        });
        static::deleted(function ($app) {
            $app->opportunity?->decrement('applications_count');
        });
    }
}