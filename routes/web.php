<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //------------------EMPLOYEE RELATED ROUTES---------------------------
    Route::get('/employee', function () {
        return view('sidebar.employee');
    });

    Route::resource('employee','JoinUserDeptController');

    Route::get('/json-departments', 'JoinUserDeptController@departments');


    //------------------FORM RELATED ROUTES---------------------------
    Route::get('/manageformtype', function(){
        return view('sidebar.manageformtype');
    });

    //FOR GET THE VALUES OF FORM TYPE
    Route::get('/formtype', 'FormController@index');

    //FOR INSERT THE VALUES OF FORM TYPE
    Route::post('/storeformtype', 'FormController@store');

    Route::resource('manageformtype', 'FormController');

    //------------------FUNCTION TYPE RELATED ROUTES---------------------------
    Route::get('/managefunctionstype', function(){
        return view('sidebar.managefunctionstype');
    });

    //FOR INSERT DATA FUNCTIONTYPE
    Route::post('/storefunctionstype', 'FunctionTypeController@store');

    Route::resource('managefunctionstype', 'FunctionTypeController');

    //------------------ ORGANIZATION RELATED ROUTES---------------------------
    Route::get('/manageorganization', function(){
        return view('sidebar.manageorganization');
    });

    //ROUTE RESOURCE ORGANIZATION
    Route::resource('manageorganization', 'OrganizationController');

    //FOR INSERT DATA ORGANIZATION
    Route::post('/storeorganization', 'OrganizationController@store');

    //FOR SEARCH DATA ORGANIZATION
    Route::get('/searchorganization', 'OrganizationController@search');

    //------------------EVALUATION FORM RELATED ROUTES---------------------------
    Route::get('/ipcrcsassocp', function () {
        return view('ipcr.ipcrcsassocp');
    });

    Route::get('/ipcrcsassocp', 'IpcrController@getipcrcsassocp');

    Route::get('/ipcrcsassisp', function () {
        return view('ipcr.ipcrcsassisp');
    });

    Route::get('/ipcrcsassisp', 'IpcrController@getipcrcsassisp');

    Route::get('/ipcrcsinstructor', function () {
        return view('ipcr.ipcrcsinstructor');
    });

    Route::get('/ipcrcsinstructor', 'IpcrController@getipcrcsinstructor');

    Route::get('/ipcrcsprofessor', function () {
        return view('ipcr.ipcrcsprofessor');
    });

    Route::get('/ipcrcsprofessor', 'IpcrController@getipcrcsprofessor');

    Route::get('/ipcrfafassocp', function () {
        return view('ipcr.ipcrfafassocp');
    });

    Route::get('/ipcrfafassocp', 'IpcrController@getipcrfafassocp');

    Route::get('/ipcrfafassisp', function () {
        return view('ipcr.ipcrfafassisp');
    });

    Route::get('/ipcrfafassisp', 'IpcrController@getipcrfafassisp');

    Route::get('/ipcrfafinstructor', function () {
        return view('ipcr.ipcrfafinstructor');
    });

    Route::get('/ipcrfafinstructor', 'IpcrController@getipcrfafinstructor');

    Route::get('/ipcrfafprofessor', function () {
        return view('ipcr.ipcrfafprofessor');
    });

    Route::get('/ipcrfafprofessor', 'IpcrController@getipcrfafprofessor');

    Route::get('/ipcrfqfassocp', function () {
        return view('ipcr.ipcrfqfassocp');
    });

    Route::get('/ipcrfqfassocp', 'IpcrController@getipcrfqfassocp');

    Route::get('/ipcrfqfassisp', function () {
        return view('ipcr.ipcrfqfassisp');
    });

    Route::get('/ipcrfqfassisp', 'IpcrController@getipcrfqfassisp');


    Route::get('/ipcrfqfprofessor', function () {
        return view('ipcr.ipcrfqfprofessor');
    });

    Route::get('/ipcrfqfprofessor', 'IpcrController@getipcrfqfprofessor');

    Route::get('/ipcrfqfinstructor', function () {
        return view('ipcr.ipcrfqfinstructor');
    });

    Route::get('/ipcrfqfinstructor', 'IpcrController@getipcrfqfinstructor');

    Route::get('/ipcrfassprofessor', function () {
        return view('ipcr.ipcrfassprofessor');
    });

    Route::get('/ipcrfassprofessor', 'IpcrController@getipcrfassprofessor');

    Route::get('/ipcrfastprofessor', function () {
        return view('ipcr.ipcrfassprofessor');
    });

    Route::get('/ipcrfastprofessor', 'IpcrController@getipcrfastprofessor');

    Route::get('/ipcrfprofessor', function () {
        return view('ipcr.ipcrfprofessor');
    });

    Route::get('/ipcrfprofessor', 'IpcrController@getipcrfprofessor');

    Route::get('/ipcrfinstructor', function () {
        return view('ipcr.ipcrfinstructor');
    });

    Route::get('/ipcrfinstructor', 'IpcrController@getipcrfinstructor');


    Route::get('/ipcrfulladmin', function () {
        return view('ipcr.ipcrfassprofessor');
    });

    Route::get('/ipcrfulladmin', 'IpcrController@getipcrfulladmin');

    //------------------MANAGE EVALUATION FORM (MFO) RELATED ROUTES---------------------------
    //FOR GET THE VALUES OF MFOS
    Route::get('/manageevaluationforms', 'MfoController@index');

    //FOR INSERT DATA MFOS
    Route::post('/storemfo','MfoController@store');

    //FOR SEARCH DATA MFOS
    Route::get('/searchmfo', 'MfoController@search');

    //EDIT MFO FORM
    Route::get('/editevaluationforms', function () {
        return view('sidebar.editevaluationforms');
    });

    Route::resource('manageevaluationforms', 'MfoController');

    Route::get('/home', 'HomeController@index')->name('home');
});


