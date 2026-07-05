<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOfStudy extends Model
{
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'field_id');
    }
}