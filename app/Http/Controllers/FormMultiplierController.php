<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormMultiplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormMultiplierController extends Controller
{

    public function index()
    {
        $multiplier = DB::table('formmultipliers')
            ->select('id', 'form_name', 'function_name', 'multiplier')
            ->orderBy('form_name', 'asc')
            ->orderBy('function_name', 'asc')
            ->get();

        return view('sidebar.managemultiplier', compact('multiplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'form_name' => 'required',
            'function_name' => 'required',
            'multiplier' => 'required',
        ]);

        $multiplier = new FormMultiplier();
        $multiplier->form_name = request('form_name');
        $multiplier->function_name = request('function_name');
        $multiplier->multiplier = request('multiplier');
        $multiplier->save();

        session()->flash('postmessage', 'Succesfully added Form Multiplier!');

        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'form_name' => 'required',
            'function_name' => 'required',
            'multiplier' => 'required',
        ]);

        $multiplier = FormMultiplier::find($request->formmultiplierid);
        $multiplier -> form_name = $request->input('form_name');
        $multiplier -> function_name = $request->input('function_name');
        $multiplier -> multiplier = $request->input('multiplier');
        $multiplier -> update();

        session()->flash('updatemessage', 'Succesfully updated Form Multiplier!');

        return back();
    }

    public function destroy(Request $request)
    {
        FormMultiplier::destroy($request->formmultiplierid);

        session()->flash('deletemessage', 'Succesfully deleted Form Multiplier');

        return back();
    }
}
