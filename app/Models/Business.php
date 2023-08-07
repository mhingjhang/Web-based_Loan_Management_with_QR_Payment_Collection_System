<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';
    protected $primaryKey = 'BusinessID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

}
