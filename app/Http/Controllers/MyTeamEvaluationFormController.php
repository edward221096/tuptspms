<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyTeamEvaluationFormController extends Controller
{
    public function index(){
        $myuserid = Auth::User()->id;
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
            ->select('ratings.form_sequence_id as id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                'ratings.evaluation_enddate', 'ratings.evaluationform_status')
            ->where('sections.id', '=', $mysectionid)
            ->where('role', '!=', 'Department Head')
            ->where('role', '!=', 'Division Head')
            ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status')
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
                ->select('ratings.form_sequence_id as id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status')
                ->where('ratings.dept_id', '=', $mydeptid)
                ->where('role', '!=', 'Division Head')
                ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status')
                ->orderBy('ratings.evaluationform_status')
                ->get();
        }elseif (Auth::User()->role == 'Division Head') {
            $myteamevaluationform = DB::table('ratings')
                ->join('users', 'users.id', '=', 'ratings.user_id')
                ->join('forms', 'forms.id', '=', 'ratings.form_id')
                ->join('divisions', 'divisions.id', '=', 'ratings.division_id')
                ->join('departments', 'departments.id', '=', 'ratings.dept_id')
                ->join('sections', 'sections.id', '=', 'ratings.section_id')
                ->select('ratings.form_sequence_id as id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                    'ratings.evaluation_enddate', 'ratings.evaluationform_status')
                ->where('divisions.id', '=', $mydivisionid)
                ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                    'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status')
                ->orderBy('ratings.evaluationform_status')
                ->get();
        }

        return view('sidebar.myteamevaluationforms', compact('myteamevaluationform'));
    }

    public function destroy(){


    }
}
