<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CollectorSite;
use App\Models\CollectionView;
use App\Models\Remittance;

class CollectionController extends Controller
{
    public function show()
    {
        $currentDate = now()->toDateString();

        $recordedAmountSubquery = "(SELECT COALESCE(SUM(p.PaymentAmount), 0) FROM payments p WHERE p.EmployeeID = e.EmployeeID AND p.PaymentDate = '$currentDate')";
        $receivedAmountSubquery = "(SELECT COALESCE(SUM(r.RemittanceAmount), 0) FROM remittances r WHERE r.EmployeeID = e.EmployeeID AND r.RemittanceDate = '$currentDate')";

        $collections = CollectorSite::select(
            'e.EmployeeID',
            DB::raw("CONCAT(e.FirstName, ' ', e.LastName) AS CollectorName"),
            'e.ProfilePicture',
            DB::raw('GROUP_CONCAT(DISTINCT a.Area SEPARATOR \', \') AS AreaAssigned'),
            DB::raw("($recordedAmountSubquery) AS ActualRecordedAmount"),
            DB::raw("($receivedAmountSubquery) AS ActualAmountReceived"),
            DB::raw("($recordedAmountSubquery - $receivedAmountSubquery) AS Balance")
        )
        ->from('collector_sites AS cs')
        ->join('employees AS e', 'cs.EmployeeID', '=', 'e.EmployeeID')
        ->join('areas AS a', 'cs.AreaID', '=', 'a.AreaID')
        ->groupBy(
            'e.EmployeeID',
            'e.FirstName',
            'e.LastName',
            'e.ProfilePicture'
        )
        ->get();

        return view('LoanManagement.collection', ['collections' => $collections, 'currentDate' => $currentDate]);
    
    }

    public function store(Request $request, $id)
    {
       
        // Validation
        $data = $request->validate([
            'collectionAmount' => 'required|numeric',
        ]);

        $remittance = new Remittance;
        $remittance->RemittanceDate = now()->toDateString();
        $remittance->RemittanceAmount = $data['collectionAmount'];
        $remittance->EmployeeID = $id;
        $remittance->save();

        return back()->with('success', 'Fund Added successfully!');
    }



}
