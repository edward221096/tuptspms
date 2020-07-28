<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyDashboardController extends Controller
{
    public function getTotalIpcrWeightedScore(){
        $myuserid = Auth::User()->id;

        $getmyweightedscore = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->select('total_weighted_score',
                DB::raw('concat(LEFT(MONTHNAME(UPPER(evaluation_startdate)), 3)," ",
                YEAR(evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(evaluation_enddate)),3), " ",
                YEAR(evaluation_enddate)) as evaluation_period'))
            ->where('user_id', '=', $myuserid)
            ->where('form_type', '=', 'IPCR')
            ->where('evaluationform_status', 'Approved (Cannot be edited)')
            ->groupBy('form_sequence_id', 'total_weighted_score', 'evaluation_period')
            ->get();

        return response()->json($getmyweightedscore);
    }

    public function getTotalOpcrWeightedScore(){
        $myuserid = Auth::User()->id;

        $getmyweightedscore = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->select('total_weighted_score',
                DB::raw('concat(LEFT(MONTHNAME(UPPER(evaluation_startdate)), 3)," ",
                YEAR(evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(evaluation_enddate)),3), " ",
                YEAR(evaluation_enddate)) as evaluation_period'))
            ->where('user_id', '=', $myuserid)
            ->where('form_type', '=', 'OPCR')
            ->where('evaluationform_status', 'Approved (Cannot be edited)')
            ->groupBy('form_sequence_id', 'total_weighted_score', 'evaluation_period')
            ->get();

        return response()->json($getmyweightedscore);
    }
}
