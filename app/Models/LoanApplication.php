<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;
    protected $table = 'loan_applications';
    protected $primaryKey = 'LoanApplicationID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'ClientID');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
    }

    public function approval()
    {
        return $this->hasMany(Approval::class, 'LoanApplicationID', 'LoanApplicationID');
    }

 

   

}
