<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpcrController extends Controller
{
    public function getopcraccounting(){
        $opcraccounting = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('dept_name', '=', 'Accounting')
            ->orderBy('functions.id')
            ->get();
        return view ('opcr.opcraccounting', compact('opcraccounting'));
    }

    public function getopcradre(){
        $opcradre = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'ADREA')
            ->get();
        return view ('opcr.opcradre', compact('opcradre'));
    }

    public function getopcrbudget(){
        $opcrbudget = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Budget')
            ->get();
        return view ('opcr.opcrbudget', compact('opcrbudget'));
    }

    public function getopcrfaculty(){
        $opcrfaculty = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Faculty')
            ->get();
        return view ('opcr.opcrfaculty', compact('opcrfaculty'));
    }

    public function getopcrcashier(){
        $opcrcashier = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Cashier')
            ->get();
        return view ('opcr.opcrcashier', compact('opcrcashier'));
    }

    public function getopcrido(){
        $opcrido = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'IDO')
            ->get();
        return view ('opcr.opcrido', compact('opcrido'));
    }

    public function getopcrindustrybased(){
        $opcrindustrybased = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Industry-Based')
            ->get();
        return view ('opcr.opcrindustrybased', compact('opcrindustrybased'));
    }

    public function getopcrmedicalserv(){
        $opcrmedicalserv = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Medical Serrvices')
            ->get();
        return view ('opcr.opcrmedicalserv', compact('opcrmedicalserv'));
    }

    public function getopcrpdo(){
        $opcrpdo = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'PDO')
            ->get();
        return view ('opcr.opcrpdo', compact('opcrpdo'));
    }

    public function getopcrprocurement(){
        $opcrprocurement = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Procurement')
            ->get();
        return view ('opcr.opcrprocurement', compact('opcrprocurement'));
    }

    public function getopcrqaa(){
        $opcrqaa = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'QAA')
            ->get();
        return view ('opcr.opcrqaa', compact('opcrqaa'));
    }

    public function getopcrrecords(){
        $opcrrecords = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'Records')
            ->get();
        return view ('opcr.opcrrecords', compact('opcrrecords'));
    }

    public function getopcruitc(){

        $opcruitc = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.id as function_id', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'OPCR')
            ->Where('role', '=', 'UITC')
            ->get();
        return view('opcr.opcruitc', compact('opcruitc'));
        }
    }
