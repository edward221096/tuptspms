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

class IpcrController extends Controller
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

    //IPCRASSOCP VIEW
    public function getipcrcsassocp()
    {
        $ipcrcsassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Associate Professor')
            ->orderBy('functions.id')
            ->get();

        return view('ipcr.ipcrcsassocp', compact('ipcrcsassocp'));
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
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/ipcrcsassocp');
    }
    //IPCRCSASSISP VIEW
    public function getipcrcsassisp(){

        $ipcrcsassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'forms.id as form_id', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc',
                'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Assistant Professor')
            ->orderBy('functions.id')
            ->get();
        return view ('ipcr.ipcrcsassisp', compact('ipcrcsassisp'));
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
                'ratee_role' => $request->ratee_role[0],
                'rater_role' => $request->rater_role[0],
                'ratee_date' => $request->ratee_date[0],
                'rater_date' => $request->rater_date[0],
                'rater_comments' => $request->rater_comments[0],
                'evaluationform_status' => $request->evaluationform_status[0],
            ];
        }
        DB::table('ratings')->insert($store);

        return redirect('/ipcrcsassocp');
    }

    public function getipcrcsprofessor(){
        $ipcrcsprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Professor')
            ->get();
        return view ('ipcr.ipcrcsprofessor', compact('ipcrcsprofessor'));
    }

    public function getipcrcsinstructor(){
        $ipcrcsinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Instructor')
            ->get();
        return view ('ipcr.ipcrcsinstructor', compact('ipcrcsinstructor'));
    }

    public function getipcrfafassocp(){
        $ipcrfafassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Associate Professor')
            ->get();
        return view ('ipcr.ipcrfafassocp', compact('ipcrfafassocp'));
    }

    public function getipcrfafassisp(){
        $ipcrfafassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Assistant Professor')
            ->get();
        return view ('ipcr.ipcrfafassisp', compact('ipcrfafassisp'));
    }

    public function getipcrfafinstructor(){
        $ipcrfafinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Instructor')
            ->get();
        return view ('ipcr.ipcrfafinstructor', compact('ipcrfafinstructor'));
    }

    public function getipcrfafprofessor(){
        $ipcrfafprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Professor')
            ->get();
        return view ('ipcr.ipcrfafprofessor', compact('ipcrfafprofessor'));
    }

    public function getipcrfqfassocp(){
        $ipcrfqfassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Associate Professor')
            ->get();
        return view ('ipcr.ipcrfqfassocp', compact('ipcrfqfassocp'));
    }

    public function getipcrfqfassisp(){
        $ipcrfqfassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Assistant Professor')
            ->get();
        return view ('ipcr.ipcrfqfassisp', compact('ipcrfqfassisp'));
    }

    public function getipcrfqfprofessor(){
        $ipcrfqfprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Professor')
            ->get();
        return view ('ipcr.ipcrfqfprofessor', compact('ipcrfqfprofessor'));
    }

    public function getipcrfqfinstructor()
    {
        $ipcrfqfinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Instructor')
            ->get();
        return view('ipcr.ipcrfqfinstructor', compact('ipcrfqfinstructor'));
    }

    public function getipcrfulladmin(){
        $ipcrfulladmin = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Admin')
            ->get();
        return view('ipcr.ipcrfulladmin', compact('ipcrfulladmin'));
    }

    public function getipcrfassprofessor(){
        $ipcrfassprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Associate Professor')
            ->get();
        return view('ipcr.ipcrfassprofessor', compact('ipcrfassprofessor'));
    }

    public function getipcrfastprofessor(){
        $ipcrfastprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Assistant Professor')
            ->get();
        return view('ipcr.ipcrfastprofessor', compact('ipcrfastprofessor'));
    }

    public function getipcrfprofessor(){
        $ipcrfprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Professor')
            ->get();
        return view('ipcr.ipcrfprofessor', compact('ipcrfprofessor'));
    }

    public function getipcrfinstructor(){
        $ipcrfinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Instructor')
            ->get();
        return view ('ipcr.ipcrfinstructor', compact('ipcrfinstructor'));
    }
}
