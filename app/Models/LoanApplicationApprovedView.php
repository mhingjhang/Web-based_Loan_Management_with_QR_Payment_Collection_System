<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationApprovedView extends Model
{
    use HasFactory;
    protected $table = 'loan_applications_approved_view';
    public $timestamps = false;
}
