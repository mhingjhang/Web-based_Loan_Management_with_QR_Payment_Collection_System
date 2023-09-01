<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function collectorsite()
    {
        return $this->hasMany(CollectorSite::class, 'AreaID', 'AreaID');
    }
}
