<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sparepartmanagerController extends Controller
{
    public function allTransfers($column, $sort)
    {   
        $user = Auth::User()->id;
        $data = DB::table('resseption_orders')
        ->leftJoin('spareparts', 'resseption_orders.sap_kod', '=', 'spareparts.sap_kod')        
        ->join('statuses', 'resseption_orders.status_id', '=', 'statuses.id')
        ->select('resseption_orders.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->where('user_id', $user)
        ->orderBy($column, $sort)
        ->get();
        return view('transfer.alltransfer', ['data' => $data]);
    }
    public function transfered(Request $req)
    {   
        
        return redirect()->route('allTransfers', ['crm_id', 'asc']);
    }
}
