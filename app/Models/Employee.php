<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'employees';
    protected $primaryKey = 'EmployeeID';

    public function collectorsite()
    {
        return $this->hasMany(CollectorSite::class, 'CollectorSiteID', 'CollectorSiteID');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'PaymentID', 'PaymentID');
    }

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'UserAccountID');
    }

    protected $fillable = [
        // Other fillable fields...
        'Status',
    ];

    

}
