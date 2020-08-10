<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rating;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;


class MyEvaluationFormController extends Controller
{
    public function index(){
        $myuserid = Auth::User()->id;

        $myevaluationform = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('forms', 'forms.id', '=', 'ratings.form_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.form_sequence_id as id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate',
                'evaluationform_status', 'ratings.evaluationform_name')
            ->orderBy('ratings.evaluation_startdate', 'desc')
            ->orderByRaw("CASE evaluationform_status
                           WHEN 'For Review and Approval' THEN 1
                           WHEN 'For Re-evaluation' THEN 2
                           WHEN 'Approved by Head' THEN 3
                           WHEN 'Approved (Cannot be edited)' THEN 4 END DESC")
            ->get();

        return view('sidebar.myevaluationforms', compact('myevaluationform'));
    }
//--------------------------------------------------IPCR RELATED ---------------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrcsassocp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

//        var_dump($ratingsmultiplevalue);

        return view('editipcr.editipcrcsassocp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrcsassisp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

//        var_dump($ratingsmultiplevalue);

        return view('editipcr.editipcrcsassisp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrcsprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrcsprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrcsinstructor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrcsinstructor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfafassocp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfafassocp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfafassisp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfafassisp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfafprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfafprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfafinstructor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfafinstructor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfqfassocp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfqfassocp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfqfassisp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfqfassisp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfqfprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfqfprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfqfinstructor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfqfinstructor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfassprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfassprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfastprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfastprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfprofessor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfprofessor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyipcrfinstructor($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfinstructor', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 */
    public function editmyipcrfulladmin($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editipcr.editipcrfulladmin', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }
//--------------------------------------------------OPCR RELATED ---------------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrcampusdirector($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrcampusdirector', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcradaf($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcradaf', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcradaa($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcradaa', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcracademics($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcracademics', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcraccounting($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcraccounting', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcradre($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcradre', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrbudget($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrbudget', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrcashier($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrcashier', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrido($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrido', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrindustrybased($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrindustrybased', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrmedicalserv($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrmedicalserv', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrpdo($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrpdo', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrprocurement($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrprocurement', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrqaa($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrqaa', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcrrecords($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcrrecords', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editmyopcruitc($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_esignature_file', 'rater_esignature_file', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average', 'ratee_esignature_file', 'rater_esignature_file',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'evaluationform_name', 'clericalroutine', 'technical', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->get();

        $userdata = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.user_id', 'users.name', 'ratings.ratee_role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name')
            ->where('form_sequence_id', '=', $id)
            ->limit('1')
            ->get();

        return view('editopcr.editopcruitc', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request){
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

        for($x=0; $x<count($request->mfo_id); $x++){
            $test[] = [
                'id' => $request->input('rating_id')[$x],
                'user_id' => $request->user_id[0],
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->input('mfo_id')[$x],
                'mfo_desc' => $request->input('mfo_desc')[$x],
                'success_indicator_desc' => $request->success_indicator_desc[$x],
                'actual_accomplishment_desc' => $request->actual_accomplishment_desc[$x],
                'remarks' => $request->input('remarks')[$x],
                'function_name' => $request->input('function_name')[$x],
                'Q1' => $request->input('Q')[$x],
                'E2' => $request->input('E')[$x],
                'T3' => $request->input('T')[$x],
                'A4' => $request->input('A')[$x],
                'core_total_average' => $request->input('core_total_average')[0],
                'support_total_average' => $request->input('support_total_average')[0],
                'research_total_average' => $request->input('research_total_average')[0],
                'ipcr_rating_average' => $request->input('ipcr_rating_average')[0],
                'total_weighted_score' => $request->input('total_weighted_score')[0],
                'clericalroutine' => $request->input('clericalroutine')[0],
                'technical' => $request->input('technical')[0],
                'salary_grade' => $request->input('salary_grade')[0],
                'evaluation_startdate' => $request->input('evaluation_startdate')[0],
                'evaluation_enddate' => $request->input('evaluation_enddate')[0],
                'ratee_esignature' => $request->input('ratee_esignature')[0],
                'rater_esignature' => $request->input('rater_esignature')[0],
                'ratee_esignature_file' => $request->ratee_esignature_file,
                'rater_esignature_file' => $request->rater_esignature_file,
                'ratee_role' => $request->input('ratee_role')[0],
                'rater_role' => $request->input('rater_role')[0],
                'ratee_date' => $request->input('ratee_date')[0],
                'rater_date' => $request->input('rater_date')[0],
                'rater_comments' => $request->input('rater_comments')[0],
                'evaluationform_name' => $request->input('evaluationform_name')[0],
                'evaluationform_status' => $request->input('evaluationform_status')[0],
            ];
        }

        forEach($test as $data){
            $updatedata = DB::table('ratings')
                ->where('id', '=', $data["id"])
                ->where('user_id', '=', $data["user_id"])
                ->update($data);
        }
        session()->flash('updatemessage', 'You have successfully updated the form! Press back button below to go back');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if(Rating::count() > 1){
            Rating::where('form_sequence_id',  $request->form_sequence_id)->delete();
        }

        session()->flash('deletemessage', 'Form successfully deleted!');

        return back();

    }

}
