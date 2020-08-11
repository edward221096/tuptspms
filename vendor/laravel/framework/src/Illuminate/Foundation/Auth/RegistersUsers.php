<?php

namespace Illuminate\Foundation\Auth;

use App\Department;
use App\Division;
use App\Section;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function divisions(){
        $divisions = Division::all();
        return view('auth.register', compact('divisions'));
    }

    public function departments(Request $request){
        $division_id = $request->Input('division_id');
        $departments = Department::where('division_id', '=', $division_id)->get();
        return response()->json($departments);
    }

    public function sections(Request $request){
        $department_id = $request->Input('dept_id');
        $sections = Section::where('dept_id', '=', $department_id)->get();
        return response()->json($sections);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
