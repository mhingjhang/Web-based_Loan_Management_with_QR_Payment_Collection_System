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
        $currentDate = now()->toDateString(); // Get the current date in 'YYYY-MM-DD' format

        return <<<SQL
            CREATE VIEW collection_view AS
            SELECT q1.EmployeeID, CONCAT(q1.FirstName, ' ', q1.LastName) AS CollectorName, q1.ProfilePicture, q1.AreaAssigned, q2.ActualRecordedAmount, q3.ActualAmountReceived, (q2.ActualRecordedAmount - q3.ActualAmountReceived) AS Balance
            FROM (
                SELECT e.EmployeeID, e.FirstName, e.LastName, e.ProfilePicture, cs.CollectorSiteID, GROUP_CONCAT(a.Area SEPARATOR ', ') AS AreaAssigned
                FROM collector_sites cs
                JOIN employees e ON cs.EmployeeID = e.EmployeeID
                JOIN areas a ON cs.AreaID = a.AreaID
                GROUP BY e.EmployeeID, e.FirstName, e.LastName, e.ProfilePicture, cs.CollectorSiteID
            ) q1
            LEFT JOIN (
                SELECT e.EmployeeID, SUM(p.PaymentAmount) AS ActualRecordedAmount
                FROM payments p
                JOIN employees e ON p.EmployeeID = e.EmployeeID
                WHERE p.PaymentDate = '2023-07-30'
                GROUP BY e.EmployeeID
            ) q2 ON q1.EmployeeID = q2.EmployeeID
            LEFT JOIN (
                SELECT e.EmployeeID, SUM(r.RemittanceAmount) AS ActualAmountReceived
                FROM remittances r
                JOIN employees e ON r.EmployeeID = e.EmployeeID
                WHERE r.RemittanceDate = '2023-07-30'
                GROUP BY e.EmployeeID
            ) q3 ON q1.EmployeeID = q3.EmployeeID
            GROUP BY q1.EmployeeID, q1.FirstName, q1.LastName, q1.ProfilePicture, q1.AreaAssigned, q2.ActualRecordedAmount, q3.ActualAmountReceived
        SQL;
    }


    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS collection_view
        SQL;
    }
};
