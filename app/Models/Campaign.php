<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'promoter_id',
        'title',
        'description',
        'platforms',
        'niche',
        'budget',
        'timeline',
    ];

    protected $casts = [
        'platforms' => 'array',
        'timeline' => 'date',
    ];

    public function promoter()
    {
        return $this->belongsTo(Promoter::class);
    }

    public function applications()
    {
        return $this->hasMany(CampaignApplication::class);
    }
    
}
