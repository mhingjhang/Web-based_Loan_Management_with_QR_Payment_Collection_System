<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $table = 'borrowers';
    protected $primaryKey = 'BorrowerID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function loans()
    {
        return $this->hasMany('App\Models\Loan', 'BorrowerID');
    }


    
}
