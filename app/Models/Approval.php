<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $primaryKey = 'ApprovalID';

    public function approvalLevel()
    {
        return $this->belongsTo(ApprovalLevel::class, 'ApprovalLevelID', 'ApprovalLevelID');
    }

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class, 'LoanApplicationID', 'LoanApplicationID'); // Assuming you have a LoanApplication model
    }
}
