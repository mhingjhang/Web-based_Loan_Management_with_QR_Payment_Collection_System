<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectorSite extends Model
{
    use HasFactory;

    public $timestamps = false;

    
    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'AreaID');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
    }

    
}
