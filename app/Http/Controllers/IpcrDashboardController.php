<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpcrDashboardController extends Controller
{
    public function getCountIpcrEvalStatus(){
        $evalstatus = DB::table('ratings')
            ->select(DB::raw('count(distinct form_sequence_id) as count'), 'evaluationform_status')
            ->groupBy('evaluationform_status')
            ->get();

        return response()->json($evalstatus);
    }
}
