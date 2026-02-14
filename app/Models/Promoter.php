<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
    protected $fillable = [
        'company_name',
        'telegramusername',
        'telegramid',
        'company_description',
        'avatar_path',
        'is_verified',
    ];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
