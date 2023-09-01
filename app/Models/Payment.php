<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payments';
    protected $primaryKey = 'PaymentID';


    public function loan()
    {
        return $this->belongsTo('App\Models\Loan', 'LoanID');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
    }
}
