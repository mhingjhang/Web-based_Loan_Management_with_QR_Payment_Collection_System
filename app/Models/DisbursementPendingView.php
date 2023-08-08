<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementPendingView extends Model
{
    use HasFactory;
    protected $table = 'disbursement_pending_view';
    public $timestamps = false;
}
