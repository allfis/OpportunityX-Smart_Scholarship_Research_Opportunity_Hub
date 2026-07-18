<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'flag_emoji'];

    // One-to-many: A country has many opportunities
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }
}