<?php

namespace App\Http\Controllers;

use App\FunctionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FunctionTypeController extends Controller
{

    public function index()
    {
        $functiontype = DB::table('functions')
            ->select('id', 'function_name')
            ->paginate(10);

        return view ('sidebar.managefunctionstype', compact('functiontype'));

    }

    public function store(){
         $functiontype = new FunctionType();
         $functiontype->function_name=request('function_name');
         $functiontype->save();

         return redirect('/managefunctionstype');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request)
    {

        $functiontype = FunctionType::find($request->function_id);
        $functiontype -> update($request->all());
        return back();
    }

    public function destroy(Request $request)
    {
        if(FunctionType::count() > 1){
            FunctionType::destroy($request->funcid);
        }
        return redirect ('/managefunctionstype');
    }
}
