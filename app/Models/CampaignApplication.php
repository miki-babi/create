<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignApplication extends Model
{
    protected $table = 'campaign_applications';

    protected $fillable = [
        'campaign_id',
        'creator_id',
        'pitch',
        'links',
        'status',
    ];

    protected $casts = [
        'links' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
