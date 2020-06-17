<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Division;
use App\Department;
use App\Section;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = DB::table('divisions')
            ->join('departments', 'departments.division_id', 'divisions.id')
            ->join('sections', 'sections.dept_id', 'departments.id')
            ->select('divisions.id as division_id', 'departments.id as dept_id', 'sections.id as section_id','divisions.division_name', 'departments.dept_name', 'section_name')
            ->paginate(10);

        return view ('sidebar.manageorganization', compact('organizations'));
    }

    public function store(){
        $division = new Division();
        $division -> division_name = request('division_name');
        $division -> save();

        $department = new Department();
        $department -> division_id = $division->id;
        $department -> dept_name = request('dept_name');
        $department -> save();

        $section = new Section();
        $section -> dept_id = $department->id;
        $section -> section_name = request('section_name');
        $section -> save();

        return redirect('/manageorganization');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $section = Division::findorfail($request->division_id);
        $section -> division_name = $request->input('division_name');
        $section -> update();

        $section = Department::findorfail($request->dept_id);
        $section -> dept_name = $request->input('dept_name');
        $section -> update();

        $section = Section::findorfail($request->section_id);
        $section -> section_name = $request->input('section_name');
        $section -> update();

        return redirect('/manageorganization');
    }

    public function destroy(Request $request)
    {
        if(Section::count() > 1){
            Section::destroy($request->section_id);
        }
        return back();
    }

    public function search(Request $request){
        $search = $request -> get('search');

        $organizations = DB::table('divisions')
            ->join('departments', 'departments.division_id', 'divisions.id')
            ->join('sections', 'sections.dept_id', 'departments.id')
            ->select('divisions.id as division_id', 'departments.id as dept_id', 'sections.id as section_id','divisions.division_name', 'departments.dept_name', 'section_name')
            ->where('divisions.division_name', 'like', '%'.$search.'%')
            ->orWhere('departments.dept_name', 'like', '%'.$search.'%')
            ->orWhere('sections.section_name', 'like', '%'.$search.'%')
            ->paginate(10);

        return view('sidebar.manageorganization', ['organizations' => $organizations]);
    }
}
