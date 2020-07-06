<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->select('ratings.form_sequence_id', 'users.name', 'forms.form_type', 'ratings.ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'ratings.evaluation_startdate',
                'ratings.evaluation_enddate', 'ratings.evaluationform_status')
            ->where('user_id', '=', $myuserid)
            ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status')
            ->orderBy('ratings.evaluation_startdate')
            ->get();

        return view('sidebar.myevaluationforms', compact('myevaluationform'));
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }
}
