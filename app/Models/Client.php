<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'ClientID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function loanApplication()
    {
        return $this->hasMany(LoanApplication::class, 'ClientID', 'ClientID');
    }

    public function clientBusiness()
    {
        return $this->belongsTo('App\Models\ClientBusiness', 'ClientBusinessID');
    }

    
}
