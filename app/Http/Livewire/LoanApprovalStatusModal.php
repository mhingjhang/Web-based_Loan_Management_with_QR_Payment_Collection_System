<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoanApprovalStatusModal extends Modal
{
    
    public function show(){
        $this->show = true;
    }
    public function render()
    {
        return view('livewire.loan-approval-status-modal');
    }
}
