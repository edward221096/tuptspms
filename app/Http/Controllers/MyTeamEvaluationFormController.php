<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rating;

class MyTeamEvaluationFormController extends Controller
{
    public function index(){
        $mysectionid = Auth::User()->section_id;
        $mydeptid = Auth::User()->dept_id;
        $mydivisionid = Auth::User()->division_id;


        if(Auth::User()->role == 'Section Head'){
        $myteamevaluationform = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('forms', 'forms.id', '=', 'ratings.form_id')
            ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
            ->join('departments', 'departments.id', '=', 'ratings.dept_id')
            ->join('sections', 'sections.id', '=', 'ratings.section_id')
            ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
            ->where('sections.id', '=', $mysectionid)
            ->where('role', '!=', 'Department Head')
            ->where('role', '!=', 'Division Head')
            ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
            ->orderBy('ratings.evaluationform_status')
            ->get();
        }
        elseif (Auth::User()->role == 'Department Head'){
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id',  'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('ratings.dept_id', '=', $mydeptid)
                ->where('role', '!=', 'Division Head')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();
        }elseif (Auth::User()->role == 'Division Head') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('divisions.id', '=', $mydivisionid)
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();
        }elseif (Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'){
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();
        }

        return view('sidebar.myteamevaluationforms', compact('myteamevaluationform'));
    }

    public function search(Request $request)
    {

        $search = $request->get('search');

        $mysectionid = Auth::User()->section_id;
        $mydeptid = Auth::User()->dept_id;
        $mydivisionid = Auth::User()->division_id;


        if (Auth::User()->role == 'Section Head') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('sections.id', '=', $mysectionid)
                ->where('role', '!=', 'Department Head')
                ->where('role', '!=', 'Division Head')
                ->where('users.name', 'like', '%'.$search.'%')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();

            return view('sidebar.myteamevaluationforms', ['myteamevaluationform' => $myteamevaluationform]);
        } elseif (Auth::User()->role == 'Department Head') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('ratings.dept_id', '=', $mydeptid)
                ->where('role', '!=', 'Division Head')
                ->where('users.name', 'like', '%'.$search.'%')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();
            return view('sidebar.myteamevaluationforms', ['myteamevaluationform' => $myteamevaluationform]);

        } elseif (Auth::User()->role == 'Division Head') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('divisions.id', '=', $mydivisionid)
                ->Where('users.name', 'like', '%'.$search.'%')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();
            return view('sidebar.myteamevaluationforms', ['myteamevaluationform' => $myteamevaluationform]);

        } elseif (Auth::User()->role == 'Super Admin') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.id as user_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status', 'ratings.evaluationform_name')
                ->where('users.name', 'like', '%'.$search.'%')
                ->groupBy('form_sequence_id', 'users.id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status', 'ratings.evaluationform_name')
                ->orderBy('ratings.evaluationform_status')
                ->get();

            return view('sidebar.myteamevaluationforms', ['myteamevaluationform' => $myteamevaluationform]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editipcrcsassocp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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

        return view('editipcr.editipcrcsassocp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editipcrcsassisp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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

        return view('editipcr.editipcrcsassisp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editipcrcsprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrcsinstructor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfafassocp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfafassisp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfafprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfafinstructor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfqfassocp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfqfassisp($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfqfprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfqfinstructor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfassprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfastprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfprofessor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfinstructor($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editipcrfulladmin($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name', 'technical',
                'clericalroutine', 'salary_grade')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name', 'technical',
                'clericalroutine', 'salary_grade')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editopcracademics($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcraccounting($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcradre($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrbudget($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrcashier($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrido($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrindustrybased($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrmedicalserv($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrpdo($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrprocurement($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrqaa($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcrrecords($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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
    public function editopcruitc($id)
    {
        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name')
            ->get();

        $ratingsmultiplevalue = DB::table('ratings')
            ->select('id', 'mfo_id', 'function_name', 'mfo_desc', 'success_indicator_desc', 'actual_accomplishment_desc', 'remarks', 'Q1', 'E2', 'T3', 'A4')
//            ->where('user_id', '=', $getuserid->user_id)
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

    public function destroy(Request $request)
    {
        if(Rating::count() > 1){
            Rating::where('form_sequence_id',  $request->form_sequence_id)->delete();
        }

        session()->flash('deletemessage', 'Form successfully deleted!');

        return back();

    }
}
