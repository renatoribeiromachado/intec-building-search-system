<?php

use App\Http\Controllers\ActivityFieldController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\AssociateUserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanySearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\SegmentSubTypeController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkSearchController;
use App\Http\Controllers\SigController;
use App\Http\Controllers\SigCompanyController;
use App\Http\Controllers\SigAssociateController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\CronCompanyController;
use App\Http\Controllers\CronAssociateController;
use App\Http\Controllers\EmailWorkController;
use App\Http\Controllers\EmailCompanyController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::get('/', function () {
    return redirect()->route('login');
});

/*Cron*/
Route::get('cron', [CronController::class, 'cron'])->name('crom');

/*Cron empresas*/
Route::get('cronCompany', [CronCompanyController::class, 'cron'])->name('cronCompany');

/*Cron associados*/
Route::get('cronAssociate', [CronAssociateController::class, 'cron'])->name('cronAssociate');

Route::middleware(['auth', 'single.device.session'])->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard.index');
    
    /*Monitoramento - Renato Machado 08/09/2023*/
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::post('/monitoring/search', [MonitoringController::class, 'search'])->name('monitoring.search');

    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('{company}', [CompanyController::class, 'destroy'])->name('company.destroy');

        Route::post('store/{company}', [CompanyController::class, 'storeContact'])->name('company.contact.store');
        Route::put('update/{contact}', [CompanyController::class, 'updateContact'])->name('company.contact.update');
        Route::delete(
            'destroy/{contact}',
            [CompanyController::class, 'destroyContact']
        )->name('company.contact.destroy');
        Route::delete(
            'archive/{contact}',
            [CompanyController::class, 'archiveContact']
        )->name('company.contact.archive');

        Route::post('import-companies', [CompanyController::class, 'importCompanies'])->name('company.import');
        // Route::post('import-companies', function () {

        //     $activity = new \App\Models\ActivityField;
        //     $activityFound = $activity->where('description', '=', 'CONSTRUÇÃO CIVIL')->first();

        //     return $activityFound;
        // })->name('company.import');
        
        Route::get('export-companies', [CompanySearchController::class, 'export'])->name('company.search.export');

        Route::get(
            'search/step-1',
            [CompanySearchController::class, 'showCompanySearchStepOne']
        )->name('company.search.step_one.index');

        Route::get(
            'search/step-2',
            [CompanySearchController::class, 'showCompanySearchStepTwo']
        )->name('company.search.step_two.index');

        Route::get(
            'search/step-3',
            [CompanySearchController::class, 'showCompanySearchStepThree']
        )->name('company.search.step_three.index');
    });

    Route::prefix('stages')->group(function () {
        Route::get('/', [StageController::class, 'index'])->name('stage.index');
        Route::get('create', [StageController::class, 'create'])->name('stage.create');
        Route::post('store', [StageController::class, 'store'])->name('stage.store');
        Route::get('edit/{stage}', [StageController::class, 'edit'])->name('stage.edit');
        Route::post('update/{stage}', [StageController::class, 'update'])->name('stage.update');
        Route::delete('{stage}', [StageController::class, 'destroy'])->name('stage.destroy');
    });

    Route::prefix('phases')->group(function () {
        Route::get('/', [PhaseController::class, 'index'])->name('phase.index');
        Route::get('create', [PhaseController::class, 'create'])->name('phase.create');
        Route::post('store', [PhaseController::class, 'store'])->name('phase.store');
        Route::get('edit/{phase}', [PhaseController::class, 'edit'])->name('phase.edit');
        Route::post('update/{phase}', [PhaseController::class, 'update'])->name('phase.update');
        Route::delete('{phase}', [PhaseController::class, 'destroy'])->name('phase.destroy');
    });

    Route::prefix('researchers')->group(function () {
        Route::get('/', [ResearcherController::class, 'index'])->name('researcher.index');
        Route::get('create', [ResearcherController::class, 'create'])->name('researcher.create');
        Route::post('store', [ResearcherController::class, 'store'])->name('researcher.store');
        Route::get('edit/{researcher}', [ResearcherController::class, 'edit'])->name('researcher.edit');
        Route::post('update/{researcher}', [ResearcherController::class, 'update'])->name('researcher.update');
        Route::delete('{researcher}', [ResearcherController::class, 'destroy'])->name('researcher.destroy');
    });

    Route::prefix('segments')->group(function () {
        Route::get('/', [SegmentController::class, 'index'])->name('segment.index');
        Route::get('create', [SegmentController::class, 'create'])->name('segment.create');
        Route::post('store', [SegmentController::class, 'store'])->name('segment.store');
        Route::get('edit/{segment}', [SegmentController::class, 'edit'])->name('segment.edit');
        Route::put('update/{segment}', [SegmentController::class, 'update'])->name('segment.update');
        Route::delete('{segment}', [SegmentController::class, 'destroy'])->name('segment.destroy');
    });

    Route::prefix('segment-sub-types')->group(function () {
        Route::get('/', [SegmentSubTypeController::class, 'index'])->name('segment_sub_type.index');
        Route::get('create', [SegmentSubTypeController::class, 'create'])->name('segment_sub_type.create');
        Route::post('store', [SegmentSubTypeController::class, 'store'])->name('segment_sub_type.store');
        Route::get('edit/{segment_sub_type}', [SegmentSubTypeController::class, 'edit'])->name('segment_sub_type.edit');
        Route::put('update/{segment_sub_type}', [SegmentSubTypeController::class, 'update'])->name('segment_sub_type.update');
        Route::delete('{segment_sub_type}', [SegmentSubTypeController::class, 'destroy'])->name('segment_sub_type.destroy');
    });

    Route::prefix('activity_fields')->group(function () {
        Route::get('/', [ActivityFieldController::class, 'index'])->name('activity_field.index');
        Route::get('create', [ActivityFieldController::class, 'create'])->name('activity_field.create');
        Route::post('store', [ActivityFieldController::class, 'store'])->name('activity_field.store');
        Route::get('edit/{activity_field}', [ActivityFieldController::class, 'edit'])->name('activity_field.edit');
        Route::put(
            'update/{activity_field}',
            [ActivityFieldController::class, 'update']
        )->name('activity_field.update');
        Route::delete('{activity_field}', [ActivityFieldController::class, 'destroy'])->name('activity_field.destroy');
    });

    Route::prefix('v1')->group(function () {

        Route::get('segment-sub-types', function (Request $request) {
            $segmentSubTypes = \App\Models\SegmentSubType::whereSegmentId($request->segment)
                ->orderBy('description', 'asc')
                ->get();
            return response()->json(
                ['segmentSubTypes' => $segmentSubTypes],
                Response::HTTP_OK
            );
        });

        Route::get('stages', function (Request $request) {
            $stages = \App\Models\Stage::wherePhaseId($request->phase)
                ->orderBy('description', 'asc')
                ->get();
            return response()->json(
                ['stages' => $stages],
                Response::HTTP_OK
            );
        });

        Route::get(
            'companies-by-activity-field/{activity_field}',
            [WorkController::class, 'getCompaniesByItsActivityField']
        )->name('company.by.activity.field');
        
        /*Plano do associado - Renato Machado - 09/09/2023*/
        Route::get('index', [OrderController::class, 'index'])->name('associate.order.index');
        
        Route::post('apply-discount',
            [OrderController::class, 'getFinalPrice']
        )->name('associate.order.apply.discount');

        Route::post('calculate-installments',
            [OrderController::class, 'calculateInstallments']
        )->name('associate.order.calculate_installments');

        // Button Select All Works
        Route::post('check-work',
            [WorkSearchController::class, 'pushWorksSession']
        )->name('work.search.step_two.check_work');

        Route::post('remove-check-work',
            [WorkSearchController::class, 'removeWorksSession']
        )->name('work.search.step_two.remove_check_work');

        Route::post('check-all-works',
            [WorkSearchController::class, 'checkAllInputs']
        )->name('work.search.step_two.check_all_works');

        // Button Select All Companies
        Route::post('check-company',
            [CompanySearchController::class, 'pushCompaniesSession']
        )->name('company.search.step_two.check_company');

        Route::post('remove-check-company',
            [CompanySearchController::class, 'removeCompaniesSession']
        )->name('company.search.step_two.remove_check_company');

        Route::post('check-all-companies',
            [CompanySearchController::class, 'checkAllCompanies']
        )->name('work.search.step_two.check_all_companies');

        // State Select
        Route::post('state-cities',
            [CityController::class, 'getAllCitiesFromTheState']
        )->name('work.search.step_one.state_cities');
    });

    Route::prefix('roles')->group(function() {
        Route::get('', [RoleController::class, 'index'])->name('role.index');
        Route::get('create', [RoleController::class, 'create'])->name('role.create');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::get('edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('update/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('role.destroy');

        Route::get(
            '{id}/permissions',
            [RoleController::class, 'permissions']
        )->name('role.permission.edit');
        Route::put(
            'sync/permission-role',
            [RoleController::class, 'syncPermissionRole']
        )->name('role.permission.sync.permission_role');
    });

    Route::prefix('users')->group(function() {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // Route::get('{id}/permissions', 'RolesController@permissions')->name('perm.edit');
        // Route::put('sync/permission-role', 'RolesController@sync_permission_role')->name('perm.sync.permission_role');
    });
    
    /*SIG obras - Renato Machado 14/08/2023 */
    Route::get('sig-works', [SigController::class, 'index'])->name('sig_works.index');
    Route::post('sig/store', [SigController::class, 'store'])->name('sig.store');
    Route::get('sig/{id}/edit', [SigController::class, 'edit'])->name('sig.edit');
    Route::put('sig', [SigController::class, 'update'])->name('sig.update');
    Route::delete('sig/{id}', [SigController::class, 'destroy'])->name('sig.destroy');
    Route::get('sig-works/report', [SigController::class, 'report'])->name('sig_works.report');
    /*Enviar email obras*/
    Route::post('/send-email-obra', [EmailWorkController::class, 'sendEmailWork'])->name('send.email-obra');
    
    /*SIG Empresa - Renato Machado 31/08/2023 */
    Route::get('sig-companies', [SigCompanyController::class, 'index'])->name('sig_companies.index');
    Route::post('sig-company/store', [SigCompanyController::class, 'store'])->name('sig-company.store');
    Route::get('sig-company/{id}/edit', [SigCompanyController::class, 'edit'])->name('sig-company.edit');
    Route::put('sig-company', [SigCompanyController::class, 'update'])->name('sig-company.update');
    Route::get('sig-companies/report', [SigCompanyController::class, 'report'])->name('sig_companies.report');
    Route::delete('sig-company/{id}', [SigCompanyController::class, 'destroy'])->name('sig-company.destroy');
    /*Enviar email empresa - Renato machado 01/09/2023*/
    Route::post('/send-email-empresa', [EmailCompanyController::class, 'sendEmailCompany'])->name('send.email-company');
    
    
    /*SIG Associado - Renato Machado 20/09/2023 */
    Route::get('sig-associate', [SigAssociateController::class, 'index'])->name('sig_associate.index');
    Route::get('sig-sigGeral', [SigAssociateController::class, 'sigGeral'])->name('sig_associate.sigGeral');
    Route::post('sig-associate/store', [SigAssociateController::class, 'store'])->name('sig_associate.store');
    Route::get('sig-associate/{id}/edit', [SigAssociateController::class, 'edit'])->name('sig_associate.edit');
    Route::put('sig-associate', [SigAssociateController::class, 'update'])->name('sig_associate.update');
    Route::get('sig-associatereport', [SigAssociateController::class, 'report'])->name('sig_associate.report');
    Route::delete('sig-associate/{id}', [SigAssociateController::class, 'destroy'])->name('sig_associate.destroy');
    Route::post('sig-associate', [SigAssociateController::class, 'search'])->name('sig_associate.search');
    /*Enviar email empresa - Renato machado 01/09/2023*/
    Route::post('/send-email-associate', [EmailAssociateController::class, 'sendEmailAssociate'])->name('send.email-associate');
      
    Route::prefix('works')->group(function() {
        Route::get('', [WorkController::class, 'index'])->name('work.index');
        Route::get('create', [WorkController::class, 'create'])->name('work.create');
        Route::post('store', [WorkController::class, 'store'])->name('work.store');
        Route::get('edit/{work}', [WorkController::class, 'edit'])->name('work.edit');
        Route::put('update/{work}', [WorkController::class, 'update'])->name('work.update');
        Route::delete('{work}', [WorkController::class, 'destroy'])->name('work.destroy');
        /* Excel Geral -12/058/2023 - Renato Machado*/
        Route::get('excel', [WorkController::class, 'exportExcel'])->name('work.exportExcel');
        Route::post('export', [WorkController::class, 'export'])->name('work.export');

        Route::put('bind-companies/{work}', [WorkController::class, 'bindCompanies'])->name('work.bind.companies');
        Route::delete(
            'unbind-companies/{work}/{company}',
            [WorkController::class, 'unbindCompany']
        )->name('work.unbind.company');
        
        Route::put(
            'bind-activities/{work}/{company}',
            [WorkController::class, 'addCompanyActivitiesIntoWork']
        )->name('work.bind.company.activities');

        Route::put(
            'bind-contacts/{work}/{company}',
            [WorkController::class, 'addCompanyContactsIntoWork']
        )->name('work.bind.company.contacts');
        
        Route::get(
            'search/step-1',
            [WorkSearchController::class, 'showWorkSearchStepOne']
        )->name('work.search.step_one.index');

        Route::get(
            'search/step-2',
            [WorkSearchController::class, 'showWorkSearchStepTwo']
        )->name('work.search.step_two.index');

        Route::get(
            'search/step-3',
            [WorkSearchController::class, 'showWorkSearchStepThree']
        )->name('work.search.step_three.index');

        Route::get('export-works', [WorkSearchController::class, 'export'])->name('work.search.export');
        /*auto-complete Obras/empresa (Fantasia) - Renato machado 30/08/2023*/
        Route::get('/works/getCompany', [WorkSearchController::class, 'getCompany'])->name('works.getCompany');
        
        /*auto-complete Empresa (Razão social) - Renato machado 31/08/2023*/
        Route::get('/works/getCompanyName', [WorkSearchController::class, 'getCompanyName'])->name('works.getCompanyName');

    });

    Route::prefix('associates')->group(function() {
        Route::get('/', AssociateController::class)->name('associate.index');
        Route::get('create', [AssociateController::class, 'create'])->name('associate.create');
        Route::post('store', [AssociateController::class, 'store'])->name('associate.store');
        Route::get('edit/{associate}', [AssociateController::class, 'edit'])->name('associate.edit');
        Route::put('{associate}', [AssociateController::class, 'update'])->name('associate.update');

        // Add / Edit contact
        Route::post(
            'contacts/store/{company}',
            [AssociateController::class, 'storeContact']
        )->name('associate.contact.store');

        Route::put(
            'contacts/update/{contact}',
            [AssociateController::class, 'updateContact']
        )->name('associate.contact.update');

        Route::delete(
            'contacts/destroy/{contact}',
            [AssociateController::class, 'destroyContact']
        )->name('associate.contact.destroy');

        // Add / Edit Order
        Route::prefix('{company}/orders')->group(function () {
            Route::get('create', [OrderController::class, 'create'])->name('associate.order.create');
            Route::get('edit/{order}', [OrderController::class, 'edit'])->name('associate.order.edit');
            Route::post('store', [OrderController::class, 'store'])->name('associate.order.store');
            Route::put('update/{order}', [OrderController::class, 'update'])->name('associate.order.update');
            Route::delete('{order}', [OrderController::class, 'destroy'])->name('associate.order.destroy');

            Route::get('reports/{order}', OrderReportController::class)->name('associate.order.report.index');
        });

        Route::prefix('{associate}/subscriptions')->group(function () {
            Route::post('store', [SubscriptionController::class, 'store'])->name('associate.subscription.store');
        });
    });

    // Add / Edit Associate Access
    Route::prefix('associates/users')->group(function() {
        Route::get('create/{company}', [AssociateUserController::class, 'create'])->name('associate.user.create');
        Route::post('store/{company}', [AssociateUserController::class, 'store'])->name('associate.user.store');
        Route::get('edit/{company}/{contact}', [AssociateUserController::class, 'edit'])->name('associate.user.edit');
        Route::put('update/{company}/{contact}', [AssociateUserController::class, 'update'])->name('associate.user.update');
        Route::delete('destroy/{company}/{contact}', [AssociateUserController::class, 'destroy'])->name('associate.user.destroy');
    });

    Route::prefix('positions')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('position.index');
        Route::get('create', [PositionController::class, 'create'])->name('position.create');
        Route::post('store', [PositionController::class, 'store'])->name('position.store');
        Route::get('edit/{position}', [PositionController::class, 'edit'])->name('position.edit');
        Route::post('update/{position}', [PositionController::class, 'update'])->name('position.update');
        Route::delete('{position}', [PositionController::class, 'destroy'])->name('position.destroy');
    });

    // Route::resource('permissions', PermissionsController::class)
    //     ->only('index', 'create', 'store', 'edit', 'update', 'destroy')
    //     ->middleware('auth:sanctum');

    Route::prefix('permissions')->group(function () {
        Route::get('', [PermissionsController::class, 'index'])->name('permission.index');
        Route::get('create', [PermissionsController::class, 'create'])->name('permission.create');
        Route::post('store', [PermissionsController::class, 'store'])->name('permission.store');
        Route::put('{permission}', [PermissionsController::class, 'update'])->name('permission.update');
        Route::delete('{permission}', [PermissionsController::class, 'destroy'])->name('permission.destroy');
    });

    // Route::get('permission/{permission}', [PermissionsController::class, 'undo'])
    //     ->middleware('auth:sanctum')->name('permission.undo');

    // Route::resource('role', RolesController::class)
    //     ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->middleware('auth:sanctum');
    // Route::get('role/{role}', [RolesController::class, 'undo'])
    //     ->middleware('auth:sanctum')->name('role.undo');
    // Route::get('{id}/permissions', [RolesController::class, 'permissions'])
    //     ->middleware('auth:sanctum')->name('role.perm.edit');
    // Route::put('sync/permission-role', [RolesController::class, 'syncPermissionRole'])
    //     ->middleware('auth:sanctum')->name('perm.sync.permission_role');
});


require __DIR__.'/auth.php';
