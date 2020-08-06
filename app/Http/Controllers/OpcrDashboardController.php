<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpcrDashboardController extends Controller
{
    public function getCountOpcrEvalStatus()
    {
        $evalstatus = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select(DB::raw('count(distinct ratings.form_sequence_id) as count'), 'ratings.evaluationform_status', 'ratings.evaluation_startdate', DB::raw('concat(LEFT(MONTHNAME(UPPER(ratings.evaluation_startdate)), 3)," ",
                YEAR(ratings.evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(ratings.evaluation_enddate)),3), " ",
                YEAR(ratings.evaluation_enddate)) as evaluation_period'))
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->where('forms.form_type', '=', 'OPCR')
            ->groupBy('ratings.evaluationform_status', 'ratings.evaluation_startdate', 'ratings.evaluation_startdate', 'ratings.evaluation_enddate')
            ->get();

        return response()->json($evalstatus);
    }

    public function getCountWeightedScore()
    {
        $countweightedscore = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select(DB::raw('count(distinct ratings.form_sequence_id) as count'), 'ratings.evaluationform_status', DB::raw('concat(LEFT(MONTHNAME(UPPER(ratings.evaluation_startdate)), 3)," ",
                YEAR(ratings.evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(ratings.evaluation_enddate)),3), " ",
                YEAR(ratings.evaluation_enddate)) as evaluation_period'))
            ->where('total_weighted_score', '<', 3)
            ->where('evaluationform_status', '!=', 'Approved (Cannot be edited)')
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->where('form_type', '=', 'OPCR')
            ->groupBy('evaluationform_status', 'ratings.evaluation_startdate', 'ratings.evaluation_enddate')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($countweightedscore);
    }

    public function getCountperDepartment(){
        $countdepartment = DB::table('ratings')
            ->join('forms', 'ratings.form_id', '=', 'forms.id')
            ->join('departments', 'ratings.dept_id', '=', 'departments.id')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select(DB::raw('count(distinct form_sequence_id) as count'), 'departments.dept_name', DB::raw('concat(LEFT(MONTHNAME(UPPER(ratings.evaluation_startdate)), 3)," ",
                YEAR(ratings.evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(ratings.evaluation_enddate)),3), " ",
                YEAR(ratings.evaluation_enddate)) as evaluation_period'))
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->where('form_type', '=', 'OPCR')
            ->whereNotIn('departments.dept_name', ['Campus Director', 'ADAA', 'ADAF', 'ADRE', 'System Admin'])
            ->groupBy('departments.dept_name', 'ratings.evaluation_startdate', 'ratings.evaluation_enddate')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json($countdepartment);
    }

    public function getevaluated()
    {
        $getEvalPeriod = DB::table('ratings')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select(DB::raw('concat(LEFT(MONTHNAME(UPPER(ratings.evaluation_startdate)), 3)," ",
                YEAR(ratings.evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(ratings.evaluation_enddate)),3), " ",
                YEAR(ratings.evaluation_enddate)) as evaluation_period'))
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->groupBy('ratings.evaluation_startdate', 'ratings.evaluation_enddate')
            ->limit('1')
            ->get();

        $getevaluated = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('forms', 'forms.id', '=', 'ratings.form_id')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select('users.name', 'departments.dept_name', DB::raw('concat(LEFT(MONTHNAME(UPPER(ratings.evaluation_startdate)), 3)," ",
                YEAR(ratings.evaluation_startdate), " ", "to", " ", LEFT(MONTHNAME(UPPER(ratings.evaluation_enddate)),3), " ",
                YEAR(ratings.evaluation_enddate)) as evaluation_period'))
            ->where('form_type', '=', 'OPCR')
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->where('evaluationform_status', '=', 'Approved (Cannot be edited)')
            ->where('users.name', '!=', 'Super Admin')
            ->groupBy('departments.dept_name', 'users.name', 'ratings.evaluation_startdate', 'ratings.evaluation_enddate')
            ->orderBy('users.name')
            ->get();

        return view('sidebar.opcrdashboard', compact('getevaluated', 'getEvalPeriod'));
    }
}
