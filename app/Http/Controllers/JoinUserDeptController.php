<?php

namespace App\Http\Controllers;

use App\Department;
use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;


class JoinUserDeptController extends Controller
{
    function index()
    {
        $employee = DB::table('divisions')
                    ->join('users', 'users.division_id', '=', 'divisions.id')
                    ->join('departments', 'users.dept_id', '=', 'departments.id')
                    ->join('sections', 'users.section_id', '=', 'sections.id')
                    ->select('users.id', 'users.division_id', 'users.dept_id', 'users.section_id', 'users.name', 'users.username',
                        'users.email', 'users.role', 'divisions.division_name', 'departments.dept_name', 'sections.section_name', 'users.status')
                    ->orderBy('users.id', 'asc')
                    ->paginate(10);
                    return view ('sidebar.employee', compact('employee'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $employee = User::find($id);
        return view('sidebar.editemployee', compact('employee', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'email|required',
            'status' => 'required',
            'role' => 'required',
            'division_id' => 'required',
            'dept_id' => 'required',
            'section_id' => 'required'
        ]);
        $employee = User::find($request->empid);
        $employee -> name = $request->input('name');
        $employee -> username = $request->input('username');
        $employee -> email = $request->input('email');
        $employee -> status = $request->input('status');
        $employee -> role = $request->input('role');
        $employee -> division_id = $request->input('division_id');
        $employee -> dept_id = $request->input('dept_id');
        $employee -> section_id = $request->input('section_id');
        $employee -> update();

        return redirect('/employee');
    }

    public function destroy(Request $request)
    {
        if(User::count() > 1){
            User::destroy($request->empid);
        }
        return redirect('/employee');
    }

    public function departments(Request $request){
        $division_id = $request->Input('division_id');
        $departments = Department::where('division_id', '=', $division_id)->get();
        return response()->json($departments);
    }
}
