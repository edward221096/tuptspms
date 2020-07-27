<?php

namespace App\Http\Controllers;

use App\Department;
use App\Organization;
use App\Form;
use App\Mfo;
use App\FunctionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MfoController extends Controller
{

    public function index(){
        $mfo = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name',
                'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc',
                'mfos.actual_accomplishment_desc', 'mfos.remarks', 'mfos.role')
            ->paginate(10);

        return view ('sidebar.manageevaluationforms', compact('mfo'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'form_type' => 'required',
            'function_name' => 'required',
        ]);

        $formtype = Form::FirstOrCreate([
           'form_type' => request('form_type')
        ]);
        $formtype->save();

        $departments = Department::FirstOrCreate([
            'dept_name' => request('dept_name')
        ]);
        $departments->save();

        $function = FunctionType::FirstOrCreate([
            'function_name' => request('function_name')
        ]);
        $function->save();

        $mfo = new Mfo();
        $mfo->form_id=$formtype->id;
        $mfo->dept_id=$departments->id;
        $mfo->function_id=$function->id;
        $mfo->role=request('role');
        $mfo->mfo_desc=request('mfo_desc');
        $mfo->success_indicator_desc=request('success_indicator_desc');
        $mfo->actual_accomplishment_desc=request('actual_accomplishment_desc');
        $mfo->remarks = request('remarks');
        $mfo->save();

        session()->flash('postmessage', 'Successfully added Question for the selected Role or Department');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {

        $mfo = Mfo::with(['functiontype', 'departments', 'forms'])->find($id);


        return view('sidebar.editevaluationforms', compact('mfo', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
//        $this->validate($request, [
//            'form_type' => 'required',
//            'dept_name' => 'required',
//            'function_name' => 'required',
//            'mfo_desc' => 'required',
//            'success_indicator_desc' => 'required',
//            'actual_accomplishment_desc' => 'required',
//            'remarks' => 'required'
//        ]);

        $formtype = Form::FirstOrCreate([
            'form_type' => request('form_type')
        ]);
        $formtype->save();

        $departments = Department::FirstOrCreate([
            'dept_name' => request('dept_name')
        ]);
        $departments->save();

        $function = FunctionType::FirstOrCreate([
            'function_name' => request('function_name')
        ]);
        $function->save();


        $mfo = Mfo::findorFail($id);
        $mfo -> form_id = $formtype-> id;
        $mfo -> dept_id = $departments->id;
        $mfo -> function_id= $function->id;
        $mfo -> role = $request->input('role');
        $mfo -> mfo_desc = $request->input('mfo_desc');
        $mfo -> success_indicator_desc = $request->input('success_indicator_desc');
        $mfo -> actual_accomplishment_desc = $request->input('actual_accomplishment_desc');
        $mfo -> remarks = $request -> input ('remarks');
        $mfo -> save();

        session()->flash('updatemessage', 'Successfully updated information for the selected Question');

        return redirect('/manageevaluationforms');
    }

    public function destroy(Request $request){
        Mfo::destroy($request->mfoid);

        session()->flash('deletemessage', 'Successfully deleted information for the selected Question');

        return back();
    }

    public function show()
    {
        $functions_name = FunctionType::select('id', 'function_name')->get();
        return view('FunctionType', compact('functions_name'));

    }

    public function search (Request $request){
        $search = $request -> get('search');

        $mfo = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'mfos.role', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('mfos.role', 'like', '%'.$search.'%')
            ->orWhere('departments.dept_name', 'like', '%'.$search.'%')
            ->orderBy('mfos.role', 'asc')
            ->orderBy('departments.dept_name', 'asc')
            ->paginate(10);
        return view ('sidebar.manageevaluationforms', ['mfo'=>$mfo]);
    }
}//End of Controller Script
