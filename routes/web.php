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

Route::get('/password/reset', function(){
    return view('passwords.reset');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/sidebar', function () {
        return view('layouts.sidebar');
    });


    //------------------DASHBOARD RELATED ROUTES--------------------------
    //------------------MY DASHBOARD------------------------------
    Route::get('/mydashboard', function(){
        return view('sidebar.mydashboard');
    });

    Route::get('/totalipcrweightedscore', 'MyDashboardController@getTotalIpcrWeightedScore');

    Route::get('/totalopcrweightedscore', 'MyDashboardController@getTotalOpcrWeightedScore');

    //------------------IPCR DASHBOARD------------------------------
    Route::get('/ipcrdashboard', function(){
       return view('sidebar.ipcrdashboard');
    });

    Route::get('/countipcrevalstatus', 'IpcrDashboardController@getCountIpcrEvalStatus');

    Route::get('/countipcrweightedscore', 'IpcrDashboardController@getCountWeightedScore');

    Route::get('/countipcrdepartment', 'IpcrDashboardController@getCountperDepartment');

    route::get('/ipcrdashboard', 'IpcrDashboardController@getevaluated');

    //------------------OPCR DASHBOARD------------------------------
    Route::get('/opcrdashboard', function(){
        return view('sidebar.opcrdashboard');
    });

    Route::get('/countopcrevalstatus', 'OpcrDashboardController@getCountOpcrEvalStatus');

    Route::get('/countopcrweightedscore', 'OpcrDashboardController@getCountWeightedScore');

    Route::get('/countopcrdepartment', 'OpcrDashboardController@getCountperDepartment');

    route::get('/opcrdashboard', 'OpcrDashboardController@getevaluated');

    //------------------EMPLOYEE RELATED ROUTES---------------------------
    Route::get('/employee', function () {
        return view('sidebar.employee');
    });

    Route::resource('employee','JoinUserDeptController');

    Route::get('/json-departments', 'JoinUserDeptController@departments');

    Route::get('/searchemployee', 'JoinUserDeptController@search');

    //------------------MY EVALUATION FORMS RELATED ROUTES---------------------------
    Route::get('/myevaluationforms', function(){
        return view('sidebar.myevaluationforms');
    });

    Route::get('/myevaluationforms', 'MyEvaluationFormController@index');

    //------------------MY TEAM EVALUATION FORMS RELATED ROUTES---------------------------
    Route::get('/myteamevaluationforms', function(){
        return view('sidebar.myteamevaluationforms');
    });

    Route::get('myteamevaluationforms', 'MyTeamEvaluationFormController@index');

    //FOR SEARCH DATA ORGANIZATION
    Route::get('/searchteamevaluation', 'MyTeamEvaluationFormController@search');


    Route::resource('myteamevaluationforms', 'MyTeamEvaluationFormController');

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

    //------------------ EVALUATION PERIOD RELATED ROUTES---------------------------
    Route::get('/manageevaluationperiod', function () {
        return view('sidebar.manageevaluationperiod');
    });

    //FOR GET EVALUATION PERIOD
    route::get('/manageevaluationperiod', 'EvaluationPeriodController@index');

    //FOR INSERT DATA EVALUATION PERIOD
    route::post('/storeevaluationperiod', 'EvaluationPeriodController@store');

    //FOR UPDATE AND DELETE DATA EVALUATION PERIOD
    route::resource('/evaluationperiod', 'EvaluationPeriodController');

    //------------------MANAGE EVALUATION FORM (MFO) RELATED ROUTES---------------------------
    //FOR GET THE VALUES OF MFOS
    Route::get('/manageevaluationforms', 'MfoController@index');

    //FOR INSERT DATA MFOS
    Route::post('/storemfo','MfoController@store');

    //FOR SEARCH DATA DEPARTMENT OR IPCR ROLE MFOS
    Route::get('/search', 'MfoController@search');

    //EDIT MFO FORM
    Route::get('/editevaluationforms', function () {
        return view('sidebar.editevaluationforms');
    });

    Route::resource('manageevaluationforms', 'MfoController');

    //------------------EVALUATION FORM RELATED ROUTES---------------------------
    //FOR ALL UPDATE FUNCTION OF IPCR AND OPCR
    Route::resource('updatemyipcropcr', 'MyEvaluationFormController');
    Route::resource('myevaluationform', 'MyEvaluationFormController');

    //------------------IPCR---------------------------------------
    //IPCRCSASSOCP
    Route::get('/ipcrcsassocp', function () {
        return view('ipcr.ipcrcsassocp');
    });
    Route::get('/ipcrcsassocp', 'IpcrController@getipcrcsassocp');

    Route::post('/storedataipcrcsassocp', 'IpcrController@storeipcrcsassocp');


    Route::get('editmyipcrcsassocp/{id}', 'MyEvaluationFormController@editmyipcrcsassocp');

    Route::get('editipcrcsassocp/{id}', 'MyTeamEvaluationFormController@editipcrcsassocp');

    route::get('/printformipcrcsassocp/{id}', 'PrintformController@pdfexportipcrcsassocp');

    //IPCRCSASSISP
    Route::get('/ipcrcsassisp', function () {
        return view('ipcr.ipcrcsassisp');
    });

    Route::get('/ipcrcsassisp', 'IpcrController@getipcrcsassisp');

    Route::post('/storedataipcrcsassisp', 'IpcrController@storeipcrcsassisp');

    Route::get('editmyipcrcsassisp/{id}', 'MyEvaluationFormController@editmyipcrcsassisp');

    Route::get('editipcrcsassisp/{id}', 'MyTeamEvaluationFormController@editipcrcsassisp');

    route::get('/printformipcrcsassisp/{id}', 'PrintformController@pdfexportipcrcsassisp');

    //IPCRCSINSTRUCTOR
    Route::get('/ipcrcsinstructor', function () {
        return view('ipcr.ipcrcsinstructor');
    });

    Route::get('/ipcrcsinstructor', 'IpcrController@getipcrcsinstructor');

    Route::post('/storedataipcrcsinstructor', 'IpcrController@storeipcrcsinstructor');

    Route::get('editmyipcrcsinstructor/{id}', 'MyEvaluationFormController@editmyipcrcsinstructor');

    Route::get('editipcrcsinstructor/{id}', 'MyTeamEvaluationFormController@editipcrcsinstructor');

    route::get('/printformipcrcsinstructor/{id}', 'PrintformController@pdfexportipcrcsinstructor');

    //IPCRCSPROFESSOR
    Route::get('/ipcrcsprofessor', function () {
        return view('ipcr.ipcrcsprofessor');
    });

    Route::get('/ipcrcsprofessor', 'IpcrController@getipcrcsprofessor');

    Route::post('/storedataipcrcsprofessor', 'IpcrController@storeipcrcsprofessor');

    Route::get('editmyipcrcsprofessor/{id}', 'MyEvaluationFormController@editmyipcrcsprofessor');

    Route::get('editipcrcsprofessor/{id}', 'MyTeamEvaluationFormController@editipcrcsprofessor');

    route::get('/printformipcrcsprofessor/{id}', 'PrintformController@pdfexportipcrcsprofessor');

    //IPCRFAFASSOCP
    Route::get('/ipcrfafassocp', function () {
        return view('ipcr.ipcrfafassocp');
    });

    Route::get('/ipcrfafassocp', 'IpcrController@getipcrfafassocp');

    Route::post('/storedataipcrfafassocp', 'IpcrController@storeipcrfafassocp');

    Route::get('editmyipcrfafassocp/{id}', 'MyEvaluationFormController@editmyipcrfafassocp');

    Route::get('editipcrfafassocp/{id}', 'MyTeamEvaluationFormController@editipcrfafassocp');

    route::get('/printformipcrfafassocp/{id}', 'PrintformController@pdfexportipcrfafassocp');

    //IPCRFAFASSISP
    Route::get('/ipcrfafassisp', function () {
        return view('ipcr.ipcrfafassisp');
    });

    Route::get('/ipcrfafassisp', 'IpcrController@getipcrfafassisp');

    Route::post('/storedataipcrfafassisp', 'IpcrController@storeipcrfafassisp');

    Route::get('editmyipcrfafassisp/{id}', 'MyEvaluationFormController@editmyipcrfafassisp');

    Route::get('editipcrfafassisp/{id}', 'MyTeamEvaluationFormController@editipcrfafassisp');

    route::get('/printformipcrfafassisp/{id}', 'PrintformController@pdfexportipcrfafassisp');

    //IPCRFAFINSTRUCTOR
    Route::get('/ipcrfafinstructor', function () {
        return view('ipcr.ipcrfafinstructor');
    });

    Route::get('/ipcrfafinstructor', 'IpcrController@getipcrfafinstructor');

    Route::post('/storedataipcrfafinstructor', 'IpcrController@storeipcrfafinstructor');

    Route::get('editmyipcrfafinstructor/{id}', 'MyEvaluationFormController@editmyipcrfafinstructor');

    Route::get('editipcrfafinstructor/{id}', 'MyTeamEvaluationFormController@editipcrfafinstructor');

    route::get('/printformipcrfafinstructor/{id}', 'PrintformController@pdfexportipcrfafinstructor');

    //IPCRFAFPROFESSOR
    Route::get('/ipcrfafprofessor', function () {
        return view('ipcr.ipcrfafprofessor');
    });

    Route::get('/ipcrfafprofessor', 'IpcrController@getipcrfafprofessor');

    Route::post('/storedataipcrfafprofessor', 'IpcrController@storeipcrfafprofessor');

    Route::get('editmyipcrfafprofessor/{id}', 'MyEvaluationFormController@editmyipcrfafprofessor');

    Route::get('editipcrfafprofessor/{id}', 'MyTeamEvaluationFormController@editipcrfafprofessor');

    route::get('/printformipcrfafprofessor/{id}', 'PrintformController@pdfexportipcrfafprofessor');

    //IPCRFQFASSOCP
    Route::get('/ipcrfqfassocp', function () {
        return view('ipcr.ipcrfqfassocp');
    });

    Route::get('/ipcrfqfassocp', 'IpcrController@getipcrfqfassocp');

    Route::post('/storedataipcrfqfassocp', 'IpcrController@storeipcrfqfassocp');

    Route::get('editmyipcrfqfassocp/{id}', 'MyEvaluationFormController@editmyipcrfqfassocp');

    Route::get('editipcrfqfassocp/{id}', 'MyTeamEvaluationFormController@editipcrfqfassocp');

    route::get('/printformipcrfqfassocp/{id}', 'PrintformController@pdfexportipcrfqfassocp');

    //IPCRFQFASSISP
    Route::get('/ipcrfqfassisp', function () {
        return view('ipcr.ipcrfqfassisp');
    });

    Route::get('/ipcrfqfassisp', 'IpcrController@getipcrfqfassisp');

    Route::post('/storedataipcrfqfassisp', 'IpcrController@storeipcrfqfassisp');

    Route::get('editmyipcrfqfassisp/{id}', 'MyEvaluationFormController@editmyipcrfqfassisp');

    Route::get('editipcrfqfassisp/{id}', 'MyTeamEvaluationFormController@editipcrfqfassisp');

    route::get('/printformipcrfqfassisp/{id}', 'PrintformController@pdfexportipcrfqfassisp');

    //IPCRFQFPROFESSOR
    Route::get('/ipcrfqfprofessor', function () {
        return view('ipcr.ipcrfqfprofessor');
    });

    Route::get('/ipcrfqfprofessor', 'IpcrController@getipcrfqfprofessor');

    Route::post('/storedataipcrfqfprofessor', 'IpcrController@storeipcrfqfprofessor');

    Route::get('editmyipcrfqfprofessor/{id}', 'MyEvaluationFormController@editmyipcrfqfprofessor');

    Route::get('editipcrfqfprofessor/{id}', 'MyTeamEvaluationFormController@editipcrfqfprofessor');

    route::get('/printformipcrfqfprofessor/{id}', 'PrintformController@pdfexportipcrfqfprofessor');

    //IPCRFQFINSTRUCTOR
    Route::get('/ipcrfqfinstructor', function () {
        return view('ipcr.ipcrfqfinstructor');
    });

    Route::get('/ipcrfqfinstructor', 'IpcrController@getipcrfqfinstructor');

    Route::post('/storedataipcrfqfinstructor', 'IpcrController@storeipcrfqfinstructor');

    Route::get('editmyipcrfqfinstructor/{id}', 'MyEvaluationFormController@editmyipcrfqfinstructor');

    Route::get('editipcrfqfinstructor/{id}', 'MyTeamEvaluationFormController@editipcrfqfinstructor');

    route::get('/printformipcrfqfinstructor/{id}', 'PrintformController@pdfexportipcrfqfinstructor');

    //IPCRFASSOCPROFESSOR
    Route::get('/ipcrfassprofessor', function () {
        return view('ipcr.ipcrfassprofessor');
    });

    Route::get('/ipcrfassprofessor', 'IpcrController@getipcrfassprofessor');

    Route::post('/storedataipcrfassprofessor', 'IpcrController@storeipcrfassprofessor');

    Route::get('editmyipcrfassprofessor/{id}', 'MyEvaluationFormController@editmyipcrfassprofessor');

    Route::get('editipcrfassprofessor/{id}', 'MyTeamEvaluationFormController@editipcrfassprofessor');

    route::get('/printformipcrfassprofessor/{id}', 'PrintformController@pdfexportipcrfassprofessor');

    //IPCRFASTPROFESSOR
    Route::get('/ipcrfastprofessor', function () {
        return view('ipcr.ipcrfassprofessor');
    });

    Route::get('/ipcrfastprofessor', 'IpcrController@getipcrfastprofessor');

    Route::post('/storedataipcrfastprofessor', 'IpcrController@storeipcrfastprofessor');

    Route::get('editmyipcrfastprofessor/{id}', 'MyEvaluationFormController@editmyipcrfastprofessor');

    Route::get('editipcrfastprofessor/{id}', 'MyTeamEvaluationFormController@editipcrfastprofessor');

    route::get('/printformipcrfastprofessor/{id}', 'PrintformController@pdfexportipcrfastprofessor');

    //IPCRFPROFESSOR
    Route::get('/ipcrfprofessor', function () {
        return view('ipcr.ipcrfprofessor');
    });

    Route::get('/ipcrfprofessor', 'IpcrController@getipcrfprofessor');

    Route::post('/storedataipcrfprofessor', 'IpcrController@storeipcrfprofessor');

    Route::get('editmyipcrfprofessor/{id}', 'MyEvaluationFormController@editmyipcrfprofessor');

    Route::get('editipcrfprofessor/{id}', 'MyTeamEvaluationFormController@editipcrfprofessor');

    route::get('/printformipcrfprofessor/{id}', 'PrintformController@pdfexportipcrfprofessor');

    //IPCRFINSTRUCTOR
    Route::get('/ipcrfinstructor', function () {
        return view('ipcr.ipcrfinstructor');
    });

    Route::get('/ipcrfinstructor', 'IpcrController@getipcrfinstructor');

    Route::post('/storedataipcrfinstructor', 'IpcrController@storeipcrfinstructor');

    Route::get('editmyipcrfinstructor/{id}', 'MyEvaluationFormController@editmyipcrfinstructor');

    Route::get('editipcrfinstructor/{id}', 'MyTeamEvaluationFormController@editipcrfinstructor');

    route::get('/printformipcrfinstructor/{id}', 'PrintformController@pdfexportipcrfinstructor');

    //IPCRFULLADMIN
    Route::get('/ipcrfulladmin', function () {
        return view('ipcr.ipcrfulladmin');
    });

    Route::get('/ipcrfulladmin', 'IpcrController@getipcrfulladmin');

    Route::post('/storedataipcrfulladmin', 'IpcrController@storeipcrfulladmin');

    Route::get('editmyipcrfulladmin/{id}', 'MyEvaluationFormController@editmyipcrfulladmin');

    Route::get('editipcrfulladmin/{id}', 'MyTeamEvaluationFormController@editipcrfulladmin');

    route::get('/printformipcrfulladmin/{id}', 'PrintformController@pdfexportipcrfulladmin');

    //---------------------------------------OPCR FORMS----------------------------------------------------
    //ADAF
    Route::get('/opcrcampusdirector', function () {
        return view('opcr.opcradaf');
    });

    Route::get('/opcrcampusdirector', 'OpcrController@getopcrcampusdirector');

    Route::post('/storedataopcrcampusdirector', 'OpcrController@storeopcrcampusdirector');

    Route::get('editmyopcrcampusdirector/{id}', 'MyEvaluationFormController@editmyopcrcampusdirector');

    Route::get('editopcrcampusdirector/{id}', 'MyTeamEvaluationFormController@editopcrcampusdirector');

    route::get('/printformopcrcampusdirector/{id}', 'PrintformController@pdfexportopcrcampusdirector');

    //ADAF
    Route::get('/opcradaf', function () {
        return view('opcr.opcradaf');
    });

    Route::get('/opcradaf', 'OpcrController@getopcradaf');

    Route::post('/storedataopcradaf', 'OpcrController@storeopcradaf');

    Route::get('editmyopcradaf/{id}', 'MyEvaluationFormController@editmyopcradaf');

    Route::get('editopcradaf/{id}', 'MyTeamEvaluationFormController@editopcradaf');

    route::get('/printformopcradaf/{id}', 'PrintformController@pdfexportopcradaf');

    //ADAA
    Route::get('/opcradaa', function () {
        return view('opcr.opcradaa');
    });

    Route::get('/opcradaa', 'OpcrController@getopcradaa');

    Route::post('/storedataopcradaa', 'OpcrController@storeopcradaa');

    Route::get('editmyopcradaa/{id}', 'MyEvaluationFormController@editmyopcradaa');

    Route::get('editopcradaa/{id}', 'MyTeamEvaluationFormController@editopcradaa');

    route::get('/printformopcradaa/{id}', 'PrintformController@pdfexportopcradaa');

    //DEPARTMENT ACADEMICS
    Route::get('/opcracademics', function () {
        return view('opcr.opcracademics');
    });

    Route::get('/opcracademics', 'OpcrController@getopcracademics');

    Route::post('/storedataopcracademics', 'OpcrController@storeopcracademics');

    Route::get('editmyopcracademics/{id}', 'MyEvaluationFormController@editmyopcracademics');

    Route::get('editopcracademics/{id}', 'MyTeamEvaluationFormController@editopcracademics');

    route::get('/printformopcracademics/{id}', 'PrintformController@pdfexportopcracademics');

    //ACCOUNTING
    Route::get('/opcraccounting', function () {
        return view('opcr.opcraccounting');
    });

    Route::get('/opcraccounting', 'OpcrController@getopcraccounting');

    Route::post('/storedataopcraccounting', 'OpcrController@storeopcraccounting');

    Route::get('editmyopcraccounting/{id}', 'MyEvaluationFormController@editmyopcraccounting');

    Route::get('editopcraccounting/{id}', 'MyTeamEvaluationFormController@editopcraccounting');

    route::get('/printformopcraccounting/{id}', 'PrintformController@pdfexportopcraccounting');

    //ADRE
    Route::get('/opcradre', function () {
        return view('opcr.opcradre');
    });

    Route::get('/opcradre', 'OpcrController@getopcradre');

    Route::post('/storedataopcradre', 'OpcrController@storeopcradre');

    Route::get('editmyopcradre/{id}', 'MyEvaluationFormController@editmyopcradre');

    Route::get('editopcradre/{id}', 'MyTeamEvaluationFormController@editopcradre');

    route::get('/printformopcradre/{id}', 'PrintformController@pdfexportopcradre');

    //BUDGET
    Route::get('/opcrbudget', function () {
        return view('opcr.opcrbudget');
    });

    Route::get('/opcrbudget', 'OpcrController@getopcrbudget');

    Route::post('/storedataopcrbudget', 'OpcrController@storeopcrbudget');

    Route::get('editmyopcrbudget/{id}', 'MyEvaluationFormController@editmyopcrbudget');

    Route::get('editopcrbudget/{id}', 'MyTeamEvaluationFormController@editopcrbudget');

    route::get('/printformopcrbudget/{id}', 'PrintformController@pdfexportopcrbudget');

    //CASHIER
    Route::get('/opcrcashier', function () {
        return view('opcr.opcrcashier');
    });

    Route::get('/opcrcashier', 'OpcrController@getopcrcashier');

    Route::post('/storedataopcrcashier', 'OpcrController@storeopcrcashier');

    Route::get('editmyopcrcashier/{id}', 'MyEvaluationFormController@editmyopcrcashier');

    Route::get('editopcrcashier/{id}', 'MyTeamEvaluationFormController@editopcrcashier');

    route::get('/printformopcrcashier/{id}', 'PrintformController@pdfexportopcrcashier');

    //IDO
    Route::get('/opcrido', function () {
        return view('ipcr.opcrido');
    });

    Route::get('/opcrido', 'OpcrController@getopcrido');

    Route::post('/storedataopcrido', 'OpcrController@storeopcrido');

    Route::get('editmyopcrido/{id}', 'MyEvaluationFormController@editmyopcrido');

    Route::get('editopcrido/{id}', 'MyTeamEvaluationFormController@editopcrido');

    route::get('/printformopcrido/{id}', 'PrintformController@pdfexportopcrido');

    //INDUSTRYBASED
    Route::get('/opcrindustrybased', function () {
        return view('opcr.opcrindustrybased');
    });

    Route::get('/opcrindustrybased', 'OpcrController@getopcrindustrybased');

    Route::post('/storedataopcrindustrybased', 'OpcrController@storeopcrindustrybased');

    Route::get('editmyopcrindustrybased/{id}', 'MyEvaluationFormController@editmyopcrindustrybased');

    Route::get('editopcrindustrybased/{id}', 'MyTeamEvaluationFormController@editopcrindustrybased');

    route::get('/printformopcrindustrybased/{id}', 'PrintformController@pdfexportopcrindustrybased');

    //MEDICAL SERV
    Route::get('/opcrmedicalserv', function () {
        return view('opcr.opcrmedicalserv');
    });

    Route::get('/opcrmedicalserv', 'OpcrController@getopcrmedicalserv');

    Route::post('/storedataopcrmedicalserv', 'OpcrController@storeopcrmedicalserv');

    Route::get('editmyopcrmedicalserv/{id}', 'MyEvaluationFormController@editmyopcrmedicalserv');

    Route::get('editopcrmedicalserv/{id}', 'MyTeamEvaluationFormController@editopcrmedicalserv');

    route::get('/printformopcrmedicalserv/{id}', 'PrintformController@pdfexportopcrmedicalserv');

    //PDO
    Route::get('/opcrpdo', function () {
        return view('opcr.opcrpdo');
    });

    Route::get('/opcrpdo', 'OpcrController@getopcrpdo');

    Route::post('/storedataopcrpdo', 'OpcrController@storeopcrpdo');

    Route::get('editmyopcrpdo/{id}', 'MyEvaluationFormController@editmyopcrpdo');

    Route::get('editopcrpdo/{id}', 'MyTeamEvaluationFormController@editopcrpdo');

    route::get('/printformopcrpdo/{id}', 'PrintformController@pdfexportopcrpdo');

    //PROCUREMENT
    Route::get('/opcrprocurement', function () {
        return view('opcr.opcrprocurement');
    });

    Route::get('/opcrprocurement', 'OpcrController@getopcrprocurement');

    Route::post('/storedataopcrprocurement', 'OpcrController@storeopcrprocurement');

    Route::get('editmyopcrprocurement/{id}', 'MyEvaluationFormController@editmyopcrprocurement');

    Route::get('editopcrprocurement/{id}', 'MyTeamEvaluationFormController@editopcrprocurement');

    route::get('/printformopcrprocurement/{id}', 'PrintformController@pdfexportopcrprocurement');

    //QAA
    Route::get('/opcrqaa', function () {
        return view('opcr.opcrqaa');
    });

    Route::get('/opcrqaa', 'OpcrController@getopcrqaa');

    Route::post('/storedataopcrqaa', 'OpcrController@storeopcrqaa');

    Route::get('editmyopcrqaa/{id}', 'MyEvaluationFormController@editmyopcrqaa');

    Route::get('editopcrqaa/{id}', 'MyTeamEvaluationFormController@editopcrqaa');

    route::get('/printformopcrqaa/{id}', 'PrintformController@pdfexportopcrqaa');

    //RECORDS
    Route::get('/opcrrecords', function () {
        return view('opcr.opcrrecords');
    });

    Route::get('/opcrrecords', 'OpcrController@getopcrrecords');

    Route::post('/storedataopcrrecords', 'OpcrController@storeopcrrecords');

    Route::get('editmyopcrrecords/{id}', 'MyEvaluationFormController@editmyopcrrecords');

    Route::get('editopcrrecords/{id}', 'MyTeamEvaluationFormController@editopcrrecords');

    route::get('/printformopcrrecords/{id}', 'PrintformController@pdfexportopcrrecords');

    //UITC
    Route::get('/opruitc', function () {
        return view('opcr.opruitc');
    });

    Route::get('/opcruitc', 'OpcrController@getopcruitc');

    Route::post('/storedataopcruitc', 'OpcrController@storeopcruitc');

    Route::get('editmyopcruitc/{id}', 'MyEvaluationFormController@editmyopcruitc');

    Route::get('editopcruitc/{id}', 'MyTeamEvaluationFormController@editopcruitc');

    route::get('/printformopcruitc/{id}', 'PrintformController@pdfexportopcruitc');


    Route::get('/home', 'HomeController@index')->name('home');
});


