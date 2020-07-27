<?php

namespace App\Http\Controllers;

use App\Form;
use App\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\TestRatings;

class OpcrController extends Controller

{
    public static function getEvaluationStartDate()
    {
        $startdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy(DB::raw('date(evaluation_startdate)'), 'desc')
            ->limit('1')
            ->get();

        return $startdate;
    }

    public static function getEvaluationEndDate()
    {
        $enddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy(DB::raw('date(evaluation_startdate)'), 'desc')
            ->limit('1')
            ->get();

        return $enddate;
    }

    public static function getUserdata()
    {
        $user_id = Auth::User()->id;

        $userdata = DB::table('users')
            ->join('sections', 'sections.id', '=', 'users.section_id')
            ->join('departments', 'departments.id', '=', 'users.dept_id')
            ->join('divisions', 'divisions.id', '=', 'users.division_id')
            ->select('sections.section_name', 'departments.dept_name', 'divisions.division_name')
            ->where('users.id', '=', $user_id)
            ->limit('1')
            ->get();

        return $userdata;
    }

    //OPCRACADEMICS VIEW
    public function getopcracademics(){

        $opcracademics = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
                'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Academics Department')
            ->orderBy('functions.id')
            ->get();

        return view ('opcr.opcracademics', compact('opcracademics'));
    }

    public function storeopcracademics(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRACCOUNTING VIEW
    public function getopcraccounting(){

        $opcraccounting = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Accounting')
            ->orderBy('functions.id')
            ->get();

            // dd($opcraccounting);
        return view ('opcr.opcraccounting', compact('opcraccounting'));
    }

    public function storeopcraccounting(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }


    //OPCRADRE VIEW
    public function getopcradre(){

        $opcradre = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'ADRE')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcradre', compact('opcradre'));
    }

    public function storeopcradre(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRBUDGET VIEW
    public function getopcrbudget(){

        $opcrbudget = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Budget')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrbudget', compact('opcrbudget'));
    }

    public function storeopcrbudget(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    public function getopcrfaculty(){
        $opcrfaculty = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Faculty')
            ->get();
        return view ('opcr.opcrfaculty', compact('opcrfaculty'));
    }

    //OPCRCASHIER VIEW
    public function getopcrcashier(){

        $opcrcashier = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Cashier')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrcashier', compact('opcrcashier'));
    }

    public function storeopcrcashier(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRIDO VIEW
    public function getopcrido(){
     $opcrido = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'IDO')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrido', compact('opcrido'));
    }

    public function storeopcrido(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRINDUSTRYBASED VIEW
    public function getopcrindustrybased(){

        $opcrindustrybased = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Industry Based')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrindustrybased', compact('opcrindustrybased'));
    }

    public function storeopcrindustrybased(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRMEDICALSERV VIEW
    public function getopcrmedicalserv(){

        $opcrmedicalserv = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Medical Service')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrmedicalserv', compact('opcrmedicalserv'));
    }

    public function storeopcrmedicalserv(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRPDO VIEW
    public function getopcrpdo(){

        $opcrpdo = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'PDO')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrpdo', compact('opcrpdo'));
    }

    public function storeopcrpdo(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRPROCUREMENT VIEW
    public function getopcrprocurement(){

        $opcrprocurement = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Procurement')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrprocurement', compact('opcrprocurement'));
    }

    public function storeopcrprocurement(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRQAA VIEW
    public function getopcrqaa(){

        $opcrqaa = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'QAA')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrqaa', compact('opcrqaa'));
    }

    public function storeopcrqaa(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRRECORDS VIEW
    public function getopcrrecords(){

        $opcrrecords = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Records')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcrrecords', compact('opcrrecords'));
    }

    public function storeopcrrecords(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }

    //OPCRUITC VIEW
    public function getopcruitc(){

        $opcruitc = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
            'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
            'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'UITC')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcruitc', compact('opcruitc'));
    }

    public function storeopcruitc(Request $request)
    {
        //to get the value of evaluation start date and store it
        $evalstartdate = DB::table('evaluationperiods')
            ->select('evaluation_startdate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of evaluation end date and store it
        $evalenddate = DB::table('evaluationperiods')
            ->select('evaluation_enddate')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_enddate', 'desc')
            ->limit('1')
            ->get();

        //to get the value of last value of ratings id then form_sequence_id + 1
        $getlastratingid = Rating::pluck('id')->last();

        $store = [];
        for ($x = 0; $x < count($request->mfo_id); $x++) {
            $store[] = [
                'user_id' => $request->user_id[0],
                'form_sequence_id' => $getlastratingid + 1,
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->mfo_id[$x],
                'mfo_desc' => $request->mfo_desc[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                //'research_total_average' => $request->research_total_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_name' => $request->evaluationform_name[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/myevaluationforms');
    }


}
