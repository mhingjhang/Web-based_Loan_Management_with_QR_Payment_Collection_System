<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW disbursement_pending_view AS
            SELECT loan_applications.LoanApplicationID,
            clients.ClientID,
            clients.BorrowerPhoto,
            CONCAT(clients.FirstName, ' ', clients.LastName) AS ClientName,
            loan_applications.Principal,
            loan_applications.Status,
            approval_levels.ApprovalLevel 
            FROM loan_applications
            JOIN clients ON loan_applications.ClientID = clients.ClientID
            JOIN approvals ON loan_applications.LoanApplicationID = approvals.LoanApplicationID
            JOIN approval_levels ON approvals.ApprovalLevelID = approval_levels.ApprovalLevelID
            WHERE loan_applications.Status != 'Approved'
        SQL;
    }
    
    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS disbursement_pending_view
        SQL;
    }

};
