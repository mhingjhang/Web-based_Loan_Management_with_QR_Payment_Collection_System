<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    protected $table = 'loan_applications';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function loan()
    {
        return $this->belongsTo('App\Models\Loan', 'LoanID');
    }

}
