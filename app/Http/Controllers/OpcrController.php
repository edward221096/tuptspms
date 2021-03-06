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
    public static function getLatestIpcrRatings(){
        $myuserid = Auth::User()->id;

        $getlatestipcrratings = DB::table('ratings')
            ->join('forms', 'forms.id', '=', 'ratings.form_id')
            ->join('evaluationperiods', 'ratings.evaluation_startdate', '=', 'evaluationperiods.evaluation_startdate')
            ->select('ratings.total_weighted_score')
            ->where('evaluationperiods.evaluation_period_status', '=', 'Open')
            ->where('forms.form_type', '=', 'IPCR')
            ->where('ratings.user_id', '=', $myuserid)
            ->orderBy('ratings.evaluation_startdate', 'desc')
            ->orderBy('ratings.form_sequence_id','desc')
            ->limit(1)
            ->get();

        return $getlatestipcrratings;
    }

    public static function isEvaluationOpen(){
        $isevaluationopen = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->get();

        return $isevaluationopen;
    }

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
    public function getopcrcampusdirector(){

        $opcrcampusdirector = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
                'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Campus Director')
            ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'Support to Operations' THEN 5
                           WHEN 'General Administration and Support' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Campus Director')
            ->get();

        return view ('opcr.opcrcampusdirector', compact('opcrcampusdirector', 'getmultiplier'));
    }

    public function storeopcrcampusdirector(Request $request)
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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

    //OPCRACADEMICS VIEW
    public function getopcradaf(){

        $opcradaf = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
                'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'ADAF')
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Higher and Advanced Education Program' THEN 5 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - ADAF')
            ->get();

        return view ('opcr.opcradaf', compact('opcradaf', 'getmultiplier'));
    }

    public function storeopcradaf(Request $request)
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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

    //OPCRADAA VIEW
    public function getopcradaa(){

        $opcradaa = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name',
                'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'ADAA')
            ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Core Administrative Functions' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'General Administration and Support' THEN 4 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - ADAA')
            ->get();

        return view ('opcr.opcradaa', compact('opcradaa', 'getmultiplier'));
    }

    public function storeopcradaa(Request $request)
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Research Program' THEN 1
                           WHEN 'Core Administrative Functions' THEN 2
                           WHEN 'General Administration and Support' THEN 3
                           WHEN 'Support to Operations' THEN 4
                           WHEN 'Higher and Advanced Education Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - ADRE')
            ->get();

        return view ('opcr.opcradre', compact('opcradre', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'General Administration and Support' THEN 5
                           WHEN 'Support to Operations' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Academics Department')
            ->get();

        return view ('opcr.opcracademics', compact('opcracademics', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Accounting')
            ->get();

        return view ('opcr.opcraccounting', compact('opcraccounting', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Budget')
            ->get();

        return view ('opcr.opcrbudget', compact('opcrbudget', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Cashier')
            ->get();

        return view ('opcr.opcrcashier', compact('opcrcashier', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
         ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - IDO')
            ->get();

        return view ('opcr.opcrido', compact('opcrido', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Industry Based')
            ->get();

        return view ('opcr.opcrindustrybased', compact('opcrindustrybased', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Medical Serv')
            ->get();

        return view ('opcr.opcrmedicalserv', compact('opcrmedicalserv', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - PDO')
            ->get();

        return view ('opcr.opcrpdo', compact('opcrpdo', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Procurement')
            ->get();

        return view ('opcr.opcrprocurement', compact('opcrprocurement', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - QAA')
            ->get();

        return view ('opcr.opcrqaa', compact('opcrqaa', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - Records')
            ->get();

        return view ('opcr.opcrrecords', compact('opcrrecords', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'General Administration and Support' THEN 2
                           WHEN 'Support to Operations' THEN 3
                           WHEN 'Higher and Advanced Education Program' THEN 4
                           WHEN 'Research Program' THEN 5
                           WHEN 'Technical Advisory Extension Program' THEN 6 END ASC")
            ->get();

        $getmultiplier = DB::table('formmultipliers')
            ->select('form_name', 'function_name', 'multiplier')
            ->where('form_name', '=', 'OPCR - UITC')
            ->get();

        return view ('opcr.opcruitc', compact('opcruitc', 'getmultiplier'));
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
                'core_multiplier' => $request->core_multiplier[0],
                'support_total_average' => $request->support_total_average[0],
                'support_multiplier' => $request->support_multiplier[0],
                'research_total_average' => $request->research_total_average[0],
                'research_multiplier' => $request->research_multiplier[0],
                'ipcr_rating_average' => $request->ipcr_rating_average[0],
                'total_weighted_score' => $request->total_weighted_score[0],
                'evaluation_startdate' => $request->evaluation_startdate[0],
                'evaluation_enddate' => $request->evaluation_enddate[0],
                'ratee_esignature' => $request->ratee_esignature[0],
                'rater_esignature' => $request->rater_esignature[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
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
