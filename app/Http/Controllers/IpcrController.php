<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpcrController extends Controller
{
    public function getipcrcsassocp(){
        $ipcrcsassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Associate Professor')
            ->get();
        return view ('ipcr.ipcrcsassocp', compact('ipcrcsassocp'));
    }

    public function getipcrcsassisp(){
        $ipcrcsassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Assistant Professor')
            ->get();
        return view ('ipcr.ipcrcsassisp', compact('ipcrcsassisp'));
    }

    public function getipcrcsprofessor(){
        $ipcrcsprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Professor')
            ->get();
        return view ('ipcr.ipcrcsprofessor', compact('ipcrcsprofessor'));
    }

    public function getipcrcsinstructor(){
        $ipcrcsinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'College Sec - Instructor')
            ->get();
        return view ('ipcr.ipcrcsinstructor', compact('ipcrcsinstructor'));
    }

    public function getipcrfafassocp(){
        $ipcrfafassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Associate Professor')
            ->get();
        return view ('ipcr.ipcrfafassocp', compact('ipcrfafassocp'));
    }

    public function getipcrfafassisp(){
        $ipcrfafassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Assistant Professor')
            ->get();
        return view ('ipcr.ipcrfafassisp', compact('ipcrfafassisp'));
    }

    public function getipcrfafinstructor(){
        $ipcrfafinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Instructor')
            ->get();
        return view ('ipcr.ipcrfafinstructor', compact('ipcrfafinstructor'));
    }

    public function getipcrfafprofessor(){
        $ipcrfafprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Admin Function - Professor')
            ->get();
        return view ('ipcr.ipcrfafprofessor', compact('ipcrfafprofessor'));
    }

    public function getipcrfqfassocp(){
        $ipcrfqfassocp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Associate Professor')
            ->get();
        return view ('ipcr.ipcrfqfassocp', compact('ipcrfqfassocp'));
    }

    public function getipcrfqfassisp(){
        $ipcrfqfassisp = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Assistant Professor')
            ->get();
        return view ('ipcr.ipcrfqfassisp', compact('ipcrfqfassisp'));
    }

    public function getipcrfqfprofessor(){
        $ipcrfqfprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Professor')
            ->get();
        return view ('ipcr.ipcrfqfprofessor', compact('ipcrfqfprofessor'));
    }

    public function getipcrfqfinstructor()
    {
        $ipcrfqfinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Faculty with Quasi Function - Instructor')
            ->get();
        return view('ipcr.ipcrfqfinstructor', compact('ipcrfqfinstructor'));
    }

    public function getipcrfulladmin(){
        $ipcrfulladmin = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Admin')
            ->get();
        return view('ipcr.ipcrfulladmin', compact('ipcrfulladmin'));
    }

    public function getipcrfassprofessor(){
        $ipcrfassprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Associate Professor')
            ->get();
        return view('ipcr.ipcrfassprofessor', compact('ipcrfassprofessor'));
    }

    public function getipcrfastprofessor(){
        $ipcrfastprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Assistant Professor')
            ->get();
        return view('ipcr.ipcrfastprofessor', compact('ipcrfastprofessor'));
    }

    public function getipcrfprofessor(){
        $ipcrfprofessor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id', '=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Professor')
            ->get();
        return view('ipcr.ipcrfprofessor', compact('ipcrfprofessor'));
    }

    public function getipcrfinstructor(){
        $ipcrfinstructor = DB::table('mfos')
            ->Join('functions', 'functions.id', '=', 'mfos.function_id')
            ->Join('forms', 'forms.id','=', 'mfos.form_id')
            ->Join('departments', 'departments.id', '=', 'mfos.dept_id')
            ->select('mfos.id', 'forms.form_type', 'departments.dept_name', 'functions.function_name', 'mfos.mfo_desc', 'mfos.success_indicator_desc', 'mfos.actual_accomplishment_desc', 'mfos.remarks')
            ->where('form_type', '=', 'IPCR')
            ->Where('role', '=', 'Fulltime - Instructor')
            ->get();
        return view ('ipcr.ipcrfinstructor', compact('ipcrfinstructor'));
    }
}
