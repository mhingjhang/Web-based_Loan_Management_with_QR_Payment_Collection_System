<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class UserAccount extends Model implements Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'user_accounts';
    protected $primaryKey = 'UserAccountID';

    public function employee()
    {
        return $this->hasMany('App\Models\Employee', 'UserAccountID');
    }

        public function getAuthIdentifierName()
    {
        return 'UserName'; // Replace with the actual column name used as the identifier.
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['UserAccountID']; // Assuming your primary key column is 'id'.
    }

    public function getAuthPassword()
    {
        return $this->Password;// Replace with the actual password column name.
    }
    
    public function getRememberToken()
    {
        return $this->attributes['remember_token'];
    }

    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value; 
    }

    public function getRememberTokenName()
    {
        // You can return an empty string or null here.
        return 'remember_token'; 
    }

}
