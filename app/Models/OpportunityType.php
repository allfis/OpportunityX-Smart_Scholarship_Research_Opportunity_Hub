<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpportunityType extends Model
{
    protected $table = 'opportunity_types';
    protected $fillable = ['name', 'slug', 'badge_class', 'color', 'icon', 'sort_order'];
    public $timestamps = false;

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'type_id');
    }
}