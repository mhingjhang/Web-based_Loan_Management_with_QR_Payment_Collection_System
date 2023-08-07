<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'LoanID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function borrower()
    {
        return $this->belongsTo('App\Models\Borrower', 'BorrowerID');
    }

    public function loanApplication()
    {
        return $this->hasOne('App\Models\LoanApplication', 'LoanID');
    }


}
