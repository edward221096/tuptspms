<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rating;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PrintformController extends Controller
{
    //------------------------------------------PRINT EVALUATION FORM FUNCTION -------------------------------------------------------------
    //IPCRCSASSOCP
    public function pdfexportipcrcsassocp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrcsassocp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRCSASSISP
    public function pdfexportipcrcsassisp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrcsassisp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRCSPROFESSOR
    public function pdfexportipcrcsprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrcsprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRCSINSTRUCTOR
    public function pdfexportipcrcsinstructor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrcsinstructor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFAFASSOCP
    public function pdfexportipcrfafassocp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfafassocp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFAFASSISP
    public function pdfexportipcrfafassisp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfafassisp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRCFAFPROFESSOR
    public function pdfexportipcrfafprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfafprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFAFINSTRUCTOR
    public function pdfexportipcrfafinstructor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfafinstructor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFQFASSOCP
    public function pdfexportipcrfqfassocp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfqfassocp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFQFASSISP
    public function pdfexportipcrfqfassisp($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfqfassisp', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFQFPROFESSOR
    public function pdfexportipcrfqfprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfqfprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFQFINSTRUCTOR
    public function pdfexportipcrfqfinstructor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfqfinstructor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCR FULL ASSOCIATE PROFESSOR
    public function pdfexportipcrfassprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfassprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCR FULL ASSISTANT PROFESSOR
    public function pdfexportipcrfastprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfastprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRCSFULLPROFESSOR
    public function pdfexportipcrfprofessor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfprofessor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFULLINSTRUCTOR
    public function pdfexportipcrfinstructor($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfinstructor', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //IPCRFULLADMIN
    public function pdfexportipcrfulladmin($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name', 'salary_grade',
                'clericalroutine', 'technical',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editipcr.editipcrfulladmin', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR CAMPUS DIRECTOR
    public function pdfexportopcrcampusdirector($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrcampusdirector', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR ADAA
    public function pdfexportopcradaa($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcradaa', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR ADAF
    public function pdfexportopcradaf($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcradaf', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR ADRE
    public function pdfexportopcrcadre($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcradre', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR ACADEMICS
    public function pdfexportopcracademics($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcracademics', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR ACCOUNTING
    public function pdfexportopcraccounting($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcraccounting', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR BUDGET
    public function pdfexportopcrbudget($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrbudget', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR CASHIER
    public function pdfexportopcrcashier($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrcashier', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR IDO
    public function pdfexportopcrido($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrido', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR INDUSTRY BASED
    public function pdfexportopcrindustrybased($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrindustrybased', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR MEDICAL SERVICES
    public function pdfexportopcrmedicalserv($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrmedicalserv', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR PDO
    public function pdfexportopcrpdo($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrpdo', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR PROCUREMENT
    public function pdfexportopcrprocurement($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrprocurement', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR QAA
    public function pdfexportopcrqaa($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrqaa', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }

    //OPCR RECORDS
    public function pdfexportopcrrecords($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcrrecords', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'));
        $snappy->setOption('enable-javascript', true);
        $snappy->setOption('javascript-delay', 1000);
        $snappy->setOption('enable-smart-shrinking', true);
        $snappy->setOption('no-stop-slow-scripts', true);
        $snappy->setPaper('a4', 'landscape');

        return $snappy->download('evaluationform.pdf');
    }

    //OPCR UITC
    public function pdfexportopcruitc($id){

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
//            ->where('user_id', '=', $getuserid->user_id)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score', 'ratings.evaluationform_name',
                'ratee_esignature_file', 'rater_esignature_file')
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

        $snappy = PDF::loadView('editopcr.editopcruitc', compact('ratingsinglevalue', 'ratingsmultiplevalue', 'userdata'))
            ->setOption('enable-javascript', true)
            ->setPaper('a4', 'landscape');

        return $snappy->stream('evaluationform.pdf');
    }
}
