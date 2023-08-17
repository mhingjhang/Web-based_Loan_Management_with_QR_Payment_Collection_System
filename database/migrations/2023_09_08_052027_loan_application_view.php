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
            CREATE VIEW loan_applications_view AS
            SELECT loan_applications.LoanApplicationID,
            clients.ClientID,
            clients.BorrowerPhoto,
            CONCAT(clients.FirstName, ' ', clients.LastName) AS ClientName,  -- assuming that clients table also has FirstName and LastName
            loan_applications.ApplicationDate,
            loan_applications.Status,
            approval_levels.ApprovalLevel -- If you want to select columns from approvals table, add here
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
            DROP VIEW IF EXISTS loan_applications_view
        SQL;
    }
};
