<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Rating;
use phpDocumentor\Reflection\Types\Integer;

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
                'ratings.evaluation_enddate', 'ratings.evaluationform_status')
            ->where('user_id', '=', $myuserid)
            ->groupBy('form_sequence_id', 'forms.form_type', 'users.name', 'ratee_role', 'divisions.division_name',
                'departments.dept_name', 'sections.section_name', 'evaluation_startdate', 'evaluation_enddate', 'evaluationform_status')
            ->orderBy('ratings.evaluation_startdate')
            ->get();

        return view('sidebar.myevaluationforms', compact('myevaluationform'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function editipcrcsassocp($id)
    {
        $myuserid = Auth::User()->id;

        $ratingsinglevalue = DB::table('ratings')
            ->select('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', DB::raw('upper(MONTHNAME(evaluation_startdate)) as evaluation_startmonth,
                year(evaluation_startdate) as evaluation_startyear, upper(MONTHNAME(evaluation_enddate)) as evaluation_endmonth,
                year(evaluation_enddate) as evaluation_endyear'),
                'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score')
            ->where('user_id', '=', $myuserid)
            ->where('form_sequence_id', '=', $id)
            ->groupby('form_sequence_id', 'user_id', 'form_id', 'division_id',
                'dept_id', 'section_id', 'evaluation_startdate', 'evaluation_enddate', 'ratee_esignature',
                'rater_esignature', 'ratee_role', 'rater_role', 'ratee_date',
                'rater_date', 'rater_comments', 'evaluationform_status', 'core_total_average', 'support_total_average',
                'research_total_average', 'ipcr_rating_average', 'total_weighted_score')
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

        return view('editipcr.editipcrcsassocp', compact('ratingsinglevalue', 'id', 'ratingsmultiplevalue', 'userdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id){
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
                'form_sequence_id' => $request->form_sequence_id[0],
                'form_id' => $request->form_id[0],
                'division_id' => $request->division_id[0],
                'dept_id' => $request->dept_id[0],
                'section_id' => $request->section_id[0],
                'mfo_id' => $request->input('mfo_id')[$x],
                'mfo_desc' => $request->input('mfo_desc')[$x],
                'success_indicator_desc' => $request->input('success_indicator_desc')[$x],
                'actual_accomplishment_desc' => $request->input('actual_accomplishment_desc')[$x],
                'remarks' => $request->input('remarks')[$x],
                'function_name' => $request->input('function_name')[$x],
                'Q1' => $request->input('Q')[$x],
                'E2' => $request->input('E')[$x],
                'T3' => $request->input('T')[$x],
                'A4' => $request->input('A')[$x],
                'core_total_average' => $request->input('core_total_average')[0],
                'support_total_average' => $request->input('support_total_average')[0],
                'research_total_average' => $request->input('research_total_average')[0],
                'total_weighted_score' => $request->input('total_weighted_score')[0],
                'evaluation_startdate' => $request->input('evaluation_startdate')[0],
                'evaluation_enddate' => $request->input('evaluation_enddate')[0],
                'ratee_esignature' => $request->input('ratee_esignature')[0],
                'rater_esignature' => $request->input('rater_esignature')[0],
                'ratee_role' => $request->input('ratee_role')[0],
                'rater_role' => $request->input('rater_role')[0],
                'ratee_date' => $request->input('ratee_date')[0],
                'rater_date' => $request->input('rater_date')[0],
                'rater_comments' => $request->input('rater_comments')[0],
                'evaluationform_status' => $request->input('evaluationform_status')[0],
            ];

        }
        forEach($test as $data){
            $updatedata = DB::table('ratings')
                ->where('id', '=', $data['id'])
                ->where('user_id',"=", $data["user_id"])
                ->update($data);
        }
        return redirect('/myevaluationforms');
    }

    public function destroy(Request $request)
    {
        if(Rating::count() > 1){
            Rating::where('form_sequence_id',  $request->form_sequence_id)->delete();
        }

        return back();

    }

}
