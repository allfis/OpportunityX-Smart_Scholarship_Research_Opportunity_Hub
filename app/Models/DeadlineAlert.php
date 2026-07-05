<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadlineAlert extends Model
{
    protected $fillable = ['user_id', 'opportunity_id', 'alert_days_before', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}