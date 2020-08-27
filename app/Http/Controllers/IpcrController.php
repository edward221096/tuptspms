<?php

namespace App\Http\Controllers;

use App\Form;
use App\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\EvaluationPeriod;
use App\TestRatings;
use Illuminate\Support\Facades\Storage;

class IpcrController extends Controller
{

    public static function isEvaluationOpen(){
        $isevaluationopen = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy('evaluation_startdate', 'desc')
            ->get();

        return $isevaluationopen;
    }

    public static function getUserDepartmentName(){
        $myuserid = Auth::User()->id;

        $getuserdepartmentname = DB::table('users')
            ->join('departments', 'users.dept_id', '=', 'departments.id')
            ->join('divisions', 'users.division_id', '=', 'divisions.id')
            ->join('sections', 'users.section_id', '=', 'sections.id')
            ->select('users.id', 'departments.dept_name', 'departments.type', 'sections.section_name', 'divisions.division_name', 'users.name')
            ->where('users.id', '=', $myuserid)
            ->get();

        return $getuserdepartmentname;
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

    //IPCRASSOCP VIEW
    public function getipcrcsassocp()
    {
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrcsassocp = DB::table('mfos')
               ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'College Sec - Associate Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrcsassocp', compact('ipcrcsassocp'));
        } else{
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRCSASSOCP
    public function storeipcrcsassocp(Request $request)
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
                'research_total_average' => $request->research_total_average[0],
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

        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }
    //IPCRCSASSISP VIEW
    public function getipcrcsassisp(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrcsassisp = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'College Sec - Assistant Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrcsassisp', compact('ipcrcsassisp'));
        } else{
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

        //STORE IPCRCSASSOCP
        public function storeipcrcsassisp(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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

        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSPROFESSOR VIEW
    public function getipcrcsprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrcsprofessor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'College Sec - Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrcsprofessor', compact('ipcrcsprofessor'));
        }
        else{
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRCSPROFESSOR
    public function storeipcrcsprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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

        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');
        return redirect('/myevaluationforms');
    }

    //IPCRCSINSTRUCTOR VIEW
    public function getipcrcsinstructor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrcsinstructor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'College Sec - Instructor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrcsinstructor', compact('ipcrcsinstructor'));
        }
        else{
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }

    }

    //STORE IPCRCSINSTRUCTOR
    public function storeipcrcsinstructor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfafassocp VIEW
    public function getipcrfafassocp(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
        $ipcrfafassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Associate Professor')
            ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
            ->get();
        return view ('ipcr.ipcrfafassocp', compact('ipcrfafassocp'));
        }
        else{
        session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
        return redirect('/myevaluationforms');
}
    }

    //STORE IPCRFAFASSOCP
    public function storeipcrfafassocp(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfafassisp VIEW
    public function getipcrfafassisp(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfafassisp = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Faculty with Admin Function - Assistant Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrfafassisp', compact('ipcrfafassisp'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRFAFASSISP
    public function storeipcrfafassisp(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfafprofessor VIEW
    public function getipcrfafprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfafprofessor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Faculty with Admin Function - Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrfafprofessor', compact('ipcrfafprofessor'));
        } else {
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

    //STORE IPCRFAFprofessor
    public function storeipcrfafprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

//IPCRCSfafinstructor VIEW
    public function getipcrfafinstructor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfafinstructor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Faculty with Admin Function - Instructor')
                ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions' THEN 1
                           WHEN 'Higher and Advanced Education Program' THEN 2
                           WHEN 'Research Program' THEN 3
                           WHEN 'Technical Advisory Extension Program' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrfafinstructor', compact('ipcrfafinstructor'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRFAFinstructor
    public function storeipcrfafinstructor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfqfassocp VIEW
    public function getipcrfqfassocp(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
        $ipcrfqfassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Associate Professor')
            ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
            ->get();
        return view ('ipcr.ipcrfqfassocp', compact('ipcrfqfassocp'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRfqfassocp
    public function storeipcrfqfassocp(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfqfassisp VIEW
    public function getipcrfqfassisp(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfqfassisp = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Faculty with Quasi Function - Assistant Professor')
                ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrfqfassisp', compact('ipcrfqfassisp'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRfqfassisp
    public function storeipcrfqfassisp(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfqfprofessor VIEW
    public function getipcrfqfprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

            foreach($get as $evalstatus){
                $evalstatus->evaluation_period_status;
            }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
                $ipcrfqfprofessor = DB::table('mfos')
                    ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                    ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                    ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                    ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                        'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                    ->where('form_type', '=', 'IPCR')
                    ->Where('role', '=', 'Faculty with Quasi Function - Professor')
                    ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                    ->get();
                return view('ipcr.ipcrfqfprofessor', compact('ipcrfqfprofessor'));
            }
            else {
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

    //STORE IPCRfqfprofessor
    public function storeipcrfqfprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRCSfqfinstructor VIEW
    public function getipcrfqfinstructor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfqfinstructor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Faculty with Quasi Function - Instructor')
                ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Core Administrative Functions' THEN 4
                           WHEN 'Support Functions' THEN 5 END ASC")
                ->get();
            return view('ipcr.ipcrfqfinstructor', compact('ipcrfqfinstructor'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRfqfinstructor
    public function storeipcrfqfinstructor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRfulladmin VIEW
    public function getipcrfulladmin(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

            foreach($get as $evalstatus){
                $evalstatus->evaluation_period_status;
            }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
                $ipcrfulladmin = DB::table('mfos')
                    ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                    ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                    ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                    ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                        'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                    ->where('form_type', '=', 'IPCR')
                    ->Where('role', '=', 'Fulltime - Admin')
                    ->orderByRaw("CASE function_name
                           WHEN 'Core Administrative Functions - Clerical/Routine' THEN 1
                           WHEN 'Core Administrative Functions - Technical' THEN 2
                           WHEN 'Support Functions' THEN 3 END ASC")
                    ->get();
                return view('ipcr.ipcrfulladmin', compact('ipcrfulladmin'));
            }
            else {
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

    //STORE IPCRfulladmin
    public function storeipcrfulladmin(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
                'clericalroutine' => $request->clericalroutine[0],
                'technical' => $request->technical[0],
                'salary_grade' => $request->salary_grade[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRfassprofessor VIEW
    public function getipcrfassprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfassprofessor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Fulltime - Associate Professor')
                ->where('functions.function_name', '!=', 'Core Administrative Functions')
                ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Support Functions' THEN 4 END ASC")
                ->get();
            return view('ipcr.ipcrfassprofessor', compact('ipcrfassprofessor'));
        }
        else {
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

    //STORE IPCRfassprofessor
    public function storeipcrfassprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRfastprofessor VIEW
    public function getipcrfastprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

            foreach($get as $evalstatus){
                $evalstatus->evaluation_period_status;
            }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
                $ipcrfastprofessor = DB::table('mfos')
                    ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                    ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                    ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                    ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                        'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                    ->where('form_type', '=', 'IPCR')
                    ->Where('role', '=', 'Fulltime - Assistant Professor')
                    ->where('functions.function_name', '!=', 'Core Administrative Functions')
                    ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Support Functions' THEN 4 END ASC")
                    ->get();
                return view('ipcr.ipcrfastprofessor', compact('ipcrfastprofessor'));
            }
            else {
                session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
                return redirect('/myevaluationforms');
            }
    }

    //STORE IPCRfastprofessor
    public function storeipcrfastprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

//IPCRfprofessor VIEW
    public function getipcrfprofessor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfprofessor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Fulltime - Professor')
                ->where('functions.function_name', '!=', 'Core Administrative Functions')
                ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Support Functions' THEN 4 END ASC")
                ->get();
            return view('ipcr.ipcrfprofessor', compact('ipcrfprofessor'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRfprofessor
    public function storeipcrfprofessor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }

    //IPCRfinstructor VIEW
    public function getipcrfinstructor(){
        $get = DB::table('evaluationperiods')
            ->select('evaluation_period_status')
            ->orderBy('evaluation_period_status', 'desc')
            ->limit(1)
            ->get();

        foreach($get as $evalstatus){
            $evalstatus->evaluation_period_status;
        }

        if($evalstatus->evaluation_period_status == 'Open' OR Auth::User()->role == 'Super Admin' OR
            Auth::User()->role == 'Division Head' OR
            Auth::User()->role == 'Department Head' OR
            Auth::User()->role == 'Section Head' OR Auth::User()->role == 'Campus Director'){
            $ipcrfinstructor = DB::table('mfos')
                ->Join('functions', 'functions.id', '=', 'mfos.function_id')
                ->Join('forms', 'forms.id', '=', 'mfos.form_id')
                ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
                ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                    'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
                ->where('form_type', '=', 'IPCR')
                ->Where('role', '=', 'Fulltime - Instructor')
                ->where('functions.function_name', '!=', 'Core Administrative Functions')
                ->orderByRaw("CASE function_name
                           WHEN 'Higher and Advanced Education Program' THEN 1
                           WHEN 'Research Program' THEN 2
                           WHEN 'Technical Advisory Extension Program' THEN 3
                           WHEN 'Support Functions' THEN 4 END ASC")
                ->get();
            return view('ipcr.ipcrfinstructor', compact('ipcrfinstructor'));
        }
        else {
            session()->flash('denied', 'Evaluation is not yet Open. Wait for the announcement');
            return redirect('/myevaluationforms');
        }
    }

    //STORE IPCRfinstructor
    public function storeipcrfinstructor(Request $request)
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
        for($x=0; $x<count($request->mfo_id); $x++){
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
                'remarks' => $request-> remarks[$x],
                'function_name' => $request->function_name[$x],
                'Q1' => $request->Q[$x],
                'E2' => $request->E[$x],
                'T3' => $request->T[$x],
                'A4' => $request->A[$x],
                'core_total_average' => $request->core_total_average[0],
                'support_total_average' => $request->support_total_average[0],
                'research_total_average' => $request->research_total_average[0],
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
        session()->flash('postmessage', 'You have successfully submitted your form! Wait for your Head to review and approve it');

        return redirect('/myevaluationforms');
    }
}
