<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name', 'short_name', 'country', 'type'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}