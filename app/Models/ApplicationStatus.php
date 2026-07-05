<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    protected $table = 'application_statuses';
    protected $fillable = ['name', 'slug', 'color_class', 'sort_order'];
    public $timestamps = false;

    public function applications()
    {
        return $this->hasMany(Application::class, 'status_id');
    }
}