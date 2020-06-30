<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index(){
        $formtype = DB::table('forms')
            ->select('id', 'form_type')
            ->paginate(10);

        return view ('sidebar.manageformtype', compact('formtype'));

    }

    public function store(){

        $formtype = new Form();
        $formtype -> form_type = request('form_type');
        $formtype -> save();

        return redirect('/manageformtype');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request)
    {

        $formtype = Form::find($request->formtype_id);
        $formtype -> update($request->all());

        return back();
    }

    public function destroy(Request $request)
    {
        if(Form::count() > 1){
            Form::destroy($request->formtype_id);
        }
        return back();
    }
}
