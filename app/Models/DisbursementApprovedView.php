<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementApprovedView extends Model
{
    use HasFactory;
    protected $table = 'disbursement_approved_view';
    public $timestamps = false;
}
