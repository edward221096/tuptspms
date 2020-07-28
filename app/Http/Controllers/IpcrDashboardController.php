<?php

namespace App\Http\Controllers;

use App\Rating;
use App\TestRatings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;

class IpcrDashboardController extends Controller
{
    public function getCountIpcrEvalStatus()
    {
        $maxevaldate = DB::table('ratings')
            ->select(DB::raw('max(evaluation_startdate) as max_evalstartdate'))
            ->get();

        foreach ($maxevaldate as $data){
         $getmaxevaldate = $data->max_evalstartdate;
        }


        $evalstatus = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->select(DB::raw('count(distinct form_sequence_id) as count'), 'evaluationform_status', 'evaluation_startdate')
            ->where('evaluation_startdate', '=', $getmaxevaldate)
            ->where('form_type', '=', 'IPCR')
            ->groupBy('evaluationform_status', 'evaluation_startdate')
            ->get();

        return response()->json($evalstatus);
    }

    public function getCountWeightedScore()
    {
        $maxevaldate = DB::table('ratings')
            ->select(DB::raw('max(evaluation_startdate) as max_evalstartdate'))
            ->get();

        foreach ($maxevaldate as $data){
            $getmaxevaldate = $data->max_evalstartdate;
        }

        $countweightedscore = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->select(DB::raw('count(distinct form_sequence_id) as count'), 'evaluationform_status')
            ->where('total_weighted_score', '<', 3)
            ->where('evaluationform_status', '!=', 'Approved (Cannot be edited)')
            ->where('evaluation_startdate', '=', $getmaxevaldate)
            ->where('form_type', '=', 'IPCR')
            ->groupBy('evaluationform_status')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($countweightedscore);
    }

    public function getCountperDepartment(){
        $maxevaldate = DB::table('ratings')
            ->select(DB::raw('max(evaluation_startdate) as max_evalstartdate'))
            ->get();

        foreach ($maxevaldate as $data){
            $getmaxevaldate = $data->max_evalstartdate;
        }

        $countdepartment = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->join('departments', 'ratings.dept_id', '=', 'departments.id')
            ->select(DB::raw('count(distinct form_sequence_id) as count'), 'departments.dept_name')
            ->where('evaluation_startdate', '=', $getmaxevaldate)
            ->where('form_type', '=', 'IPCR')
            ->whereNotIn('departments.dept_name', ['Campus Director', 'ADAA', 'ADAF', 'ADRE'])
            ->groupBy('departments.dept_name')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($countdepartment);
    }
}
