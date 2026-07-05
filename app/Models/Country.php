<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code'];
    public $timestamps = false;

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'country_id');
    }
}