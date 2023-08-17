<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBusiness extends Model
{
    use HasFactory;

    protected $table = 'client_businesses';
    protected $primaryKey = 'ClientBusinessID';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    public function client()
    {
        return $this->hasMany(Client::class, 'ClientBusinessID', 'ClientBusinessID');
    }

    
}
