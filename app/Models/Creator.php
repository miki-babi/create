<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $fillable = [
        'display_name',
        'bio',
        'telegramusername',
        'telegramid',
        'location',
        'avatar_path',
        'social_platforms',
        'niches',
    ];

    protected $casts = [
        'social_platforms' => 'array',
        'niches' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(CampaignApplication::class);
    }
}
