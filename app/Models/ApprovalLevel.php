<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'ApprovalLevelID', 'ApprovalLevelID');
    }
}
