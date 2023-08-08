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
            CREATE VIEW disbursement_approved_view AS
            SELECT CONCAT(borrowers.FirstName, ' ', borrowers.LastName) AS BorrowerName,
                borrowers.BorrowerPhoto,
                loans.Principal,
                loan_applications.Status
            FROM loan_applications
            JOIN loans ON loan_applications.LoanID = loans.LoanID
            JOIN borrowers ON loans.BorrowerID = borrowers.BorrowerID
            WHERE loan_applications.Status = 'Approved'
        SQL;
    }

    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS disbursement_approved_view
        SQL;
    }
};
