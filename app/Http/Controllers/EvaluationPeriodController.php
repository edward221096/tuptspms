<?php

namespace App\Http\Controllers;

use App\EvaluationPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationPeriodController extends Controller
{
    public function index(){
        $evaluationperiod = DB::table('evaluationperiods')
            ->select('id', 'evaluation_startdate', 'evaluation_enddate', 'evaluation_period_status')
            ->orderby('evaluation_startdate', 'desc')
            ->get();
        return view('sidebar.manageevaluationperiod', compact('evaluationperiod'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'evaluation_startdate' => 'date',
            'evaluation_enddate' => 'date',
            'evaluation_period_status' => 'required',
        ]);

        $evaluationperiod = new EvaluationPeriod();
        $evaluationperiod->evaluation_startdate = request('evaluation_startdate');
        $evaluationperiod->evaluation_enddate = request('evaluation_enddate');
        $evaluationperiod->evaluation_period_status = request('evaluation_period_status');
        $evaluationperiod->save();

        session()->flash('postmessage', 'Succesfully added Evaluation Period. Start date and End date of IPCR and OPCR forms will be based from the latest "OPEN" evaluation period status ');

        return redirect ('/manageevaluationperiod');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request){
        $this->validate($request, [
            'evaluation_startdate' => 'date',
            'evaluation_enddate' => 'date',
            'evaluation_period_status' => 'required',
        ]);

        $evaluationperiod = EvaluationPeriod::find($request->evalperiodid);
        $evaluationperiod -> evaluation_startdate = $request->input('evaluation_startdate');
        $evaluationperiod -> evaluation_enddate = $request->input('evaluation_enddate');
        $evaluationperiod -> evaluation_period_status = $request->input('evaluation_period_status');
        $evaluationperiod -> update();

        session()->flash('updatemessage', 'Succesfully updated Evaluation Period information ');

        return redirect('/manageevaluationperiod');

    }

    public function destroy(Request $request){
        EvaluationPeriod::destroy($request->evalperiodid);

        session()->flash('deletemessage', 'Succesfully deleted Evaluation Period information ');

        return redirect('/manageevaluationperiod');

    }

    public static function getEvaluationPeriod(){
        $startmonth = DB::table('evaluationperiods')
            ->select(DB::raw('year(evaluation_startdate) as start_year, year(evaluation_enddate) as end_year, upper(monthname(evaluation_startdate)) as evaluation_startdate, upper(monthname(evaluation_enddate)) as evaluation_enddate'))
            ->where('evaluation_period_status', '=', 'Open')
            ->orderBy(DB::raw('date(evaluation_startdate)'), 'desc')
            ->limit('1')
            ->get();

        return $startmonth;
    }
}
