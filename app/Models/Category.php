<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'description'];

    // One-to-many: A category has many opportunities
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }
}