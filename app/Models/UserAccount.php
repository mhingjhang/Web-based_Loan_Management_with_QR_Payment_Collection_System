<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'user_accounts';
    protected $primaryKey = 'UserAccountID';

    public function employee()
    {
        return $this->hasMany('App\Models\Employee', 'UserAccountID');
    }
}
