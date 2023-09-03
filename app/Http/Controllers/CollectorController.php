<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CollectorSite;
use App\Models\Area;

class CollectorController extends Controller
{
    public function show()
    {

        $collections = CollectorSite::select(
            'e.EmployeeID',
            DB::raw("CONCAT(e.FirstName, ' ', e.LastName) AS CollectorName"),
            'e.ProfilePicture',
            'e.ContactNumber',
            'e.Email',
            DB::raw('GROUP_CONCAT(DISTINCT a.Area SEPARATOR \', \') AS AreaAssigned'),
        )
        ->from('collector_sites AS cs')
        ->join('employees AS e', 'cs.EmployeeID', '=', 'e.EmployeeID')
        ->join('areas AS a', 'cs.AreaID', '=', 'a.AreaID')
        ->groupBy(
            'e.EmployeeID',
            'e.FirstName',
            'e.LastName',
            'e.ProfilePicture',
            'e.ContactNumber',
            'e.Email',
        )
        ->get();

        $areas = Area::all();

        return view('collector', ['collections' => $collections, 'areas' => $areas]);
    
    }

    
    public function assignArea(Request $request, $id)
    {
      
        // Validation
        $request->validate([
            'assignArea' => 'required',
        ]);


        $collectorSite = new CollectorSite;
        $collectorSite->EmployeeID = $id;
        $collectorSite->AreaID = $request->input('assignArea');;
        $collectorSite->save();

        return back()->with('success', 'Fund Added successfully!');
    }
    
}
