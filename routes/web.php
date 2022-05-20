<?php

use Illuminate\Support\Facades\Route;

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

// LOGIN
Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [App\Http\Controllers\LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
// Route::get('/reset', function () {
//     return view('auth.passwords.reset');
// });

Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    //DASHBOARD
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/task/search/status', [App\Http\Controllers\Admin\DashboardController::class, 'search'])->name('task-status-search');
    Route::put('/dashboard/add/startdate', [\App\Http\Controllers\Admin\DashboardController::class, 'dashstartdate'])->name('dash-start-date');
    Route::get('/dashboard/task/filter', [\App\Http\Controllers\Admin\DashboardController::class, 'filter'])->name('dash-filter-task');
    Route::get('/dashboard/search/{name}/{val}', [App\Http\Controllers\Admin\DashboardController::class, 'selectsearch'])->name('dash-search-task');



    // CLIENT
    Route::get('/client', [App\Http\Controllers\Admin\ClientsController::class, 'index'])->name('admin-client-client');
    Route::get('/tambahclient', [App\Http\Controllers\Admin\ClientsController::class, 'index3'])->name('admin-client-tambahclient');
    Route::post('/tambahclient', [App\Http\Controllers\Admin\ClientsController::class, 'store'])->name('admin-client-store');
    Route::get('/tambahcategory', [App\Http\Controllers\Admin\CategoryClientsController::class, 'index'])->name('admin-category-index');
    Route::post('/tambahcategory', [App\Http\Controllers\Admin\CategoryClientsController::class, 'store'])->name('admin-category-store');
    Route::put('/tambahcategory{id}{status}', [App\Http\Controllers\Admin\CategoryClientsController::class, 'status'])->name('admin-category-status');
    Route::get('/editcategory{id}', [App\Http\Controllers\Admin\CategoryClientsController::class, 'edit'])->name('admin-category-edit');
    Route::put('/editcategory{id}', [App\Http\Controllers\Admin\CategoryClientsController::class, "update"])->name('admin-category-update');
    Route::get('/editclient{id}', [App\Http\Controllers\Admin\ClientsController::class, "edit"])->name('admin-client-editclient');
    Route::put('/editclient{id}', [App\Http\Controllers\Admin\ClientsController::class, "update"])->name('admin-client');
    Route::put('/client{id}{status}', [App\Http\Controllers\Admin\ClientsController::class, "status"])->name('admin-client-status');
    Route::get('/detailclient{id}', [App\Http\Controllers\Admin\ClientsController::class, "index2"])->name('client-deatilclient');
    //COMPANY CLIENT
    Route::get('/companyclient', [\App\Http\Controllers\Admin\CompanyclientController::class, 'index'])->name('index-cc');
    Route::get('/tambahcompanyclient', [\App\Http\Controllers\Admin\CompanyclientController::class, 'index3'])->name('tambah-cc');
    Route::post('/tambahcompanyclient', [\App\Http\Controllers\Admin\CompanyclientController::class, 'store'])->name('tambah-cc-store');
    Route::put('/companyclient{id}{status}', [App\Http\Controllers\Admin\CompanyclientController::class, 'status'])->name('company-client-status');
    Route::get('/editcclient{id}', [App\Http\Controllers\Admin\CompanyclientController::class, 'edit'])->name('company-client-edit');
    Route::put('/editcclient{id}', [App\Http\Controllers\Admin\CompanyclientController::class, "update"])->name('company-client-update');
    Route::get('/detailcclient{id}', [App\Http\Controllers\Admin\CompanyclientController::class, "index2"])->name('company-client-detail');

    //ADMIN TASK
    // Route::get('admin/task', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('task-index');
    Route::get('/task', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin-task-index');
    Route::get('/task/tambah', [App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('admin-task-tambah');
    Route::post('/task/store', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('admin-task-store');
    Route::get('/task/edit/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('admin-task-edit');
    Route::put('/task/update', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('admin-task-update');
    Route::get('/task/show/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('admin-task-show');
    Route::get('/task/single/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'singleTask'])->name('admin-task-single');
    Route::get('/task/delete/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('admin-task-delete');
    Route::get('/task/search/{name}/{val}', [App\Http\Controllers\Admin\ProjectController::class, 'selectsearch'])->name('admin-search-task');
    Route::put('task/add/startdate', [\App\Http\Controllers\Admin\ProjectController::class, 'addstartDate'])->name('admin-startdate');
    Route::post('task/addpic', [App\Http\Controllers\Admin\ProjectController::class, 'addpic'])->name('admin-add-pic');
    Route::get('/task/pic/delete/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'adddestroypic'])->name('admin-deletepic');
    Route::get('/task/pic/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'showpic'])->name('admin-show-pic');


    // TASK DETAIL
    Route::get('admin/task/detail/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'detailTask'])->name('admin-task-detail');
    Route::get('admin/task/verifikasi/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'verifikasiTask'])->name('admin-verifikasi-task');
    Route::put('admin/task/revisi', [App\Http\Controllers\Admin\ProjectController::class, 'revisiTask'])->name('admin-revisi-task');
    Route::put('admin/task/gagal', [App\Http\Controllers\Admin\ProjectController::class, 'gagalTask'])->name('admin-gagal-task');
    Route::put('admin/task/batalkan', [App\Http\Controllers\Admin\ProjectController::class, 'batalkanTask'])->name('admin-batalkan-task');

    Route::put('admin/task/submit', [App\Http\Controllers\Admin\ProjectController::class, 'maneSubmit'])->name('manejemen-submit-task');

    // TASK SEARCH
    // Route::post('task', [App\Http\Controllers\Admin\ProjectController::class, 'searchDate'])->name('search-date');
    Route::get('admin/task/search', [App\Http\Controllers\Admin\ProjectController::class, 'search'])->name('admin-search');

    // SUBTASK
    Route::get('admin/task/subtask/{id}', [App\Http\Controllers\Admin\SubtaskController::class, 'index'])->name('subtask-single');
    Route::post('admin/subtask/store', [App\Http\Controllers\Admin\SubtaskController::class, 'store'])->name('subtask-store');
    //DIVISI
    //DIVISI - tampil
    Route::get('divisi/divisi', [\App\Http\Controllers\Admin\DivisionsController::class, 'index'])->name('goto-show-dbdivisions');
    Route::post('divisi/divisi', [\App\Http\Controllers\Admin\DivisionsController::class, 'store'])->name('goto-insert-dbdivisions');
    //DIVISI - update
    Route::put('divisi/updatedivisi', [\App\Http\Controllers\Admin\DivisionsController::class, 'update'])->name('goto-update-dbdivisions');
    // DIVISI - status
    Route::put('divisi/divisi{id}{status}', [\App\Http\Controllers\Admin\DivisionsController::class, 'updateStatus'])->name('goto-updatestatus-dbvisions');
    //DIVISI - delete
    Route::get('divisi/divisi{id}', [\App\Http\Controllers\Admin\DivisionsController::class, 'destroy'])->name('goto-delete-dbdivisions');
    //Divisi - Edit
    Route::get('divisi/editdivisi{id}', [\App\Http\Controllers\Admin\DivisionsController::class, 'index2'])->name('goto-edit-dbdivisions');
    Route::get('divisi/detaildivisi{id}', [\App\Http\Controllers\Admin\DivisionsController::class, 'infoModal'])->name('goto-detail-dbdivisions');
    //Divisi - Isi
    Route::get('/divisi/isiteam{id}', [\App\Http\Controllers\Admin\DivisionsController::class, 'isiTeam'])->name('goto-myisiteam');

    //Finances
    Route::get('/finance', [App\Http\Controllers\Admin\FinanceController::class, 'index'])->name('admin-finance-index');
    Route::get('/finance/create', [App\Http\Controllers\Admin\FinanceController::class, 'create'])->name('admin-finance-create');
    Route::post('/finance/store', [App\Http\Controllers\Admin\FinanceController::class, 'store'])->name('admin-finance-store');
    Route::get('/finance/detailfinance{id}', [App\Http\Controllers\Admin\FinanceController::class, 'show'])->name('admin-finance-detailfinance');
    Route::put('/finance/{id}/{status}', [App\Http\Controllers\Admin\FinanceController::class, 'status'])->name('admin-finance-status');
    Route::get('/finance/edit/{id}', [App\Http\Controllers\Admin\FinanceController::class, 'edit'])->name('admin-finance-edit');
    Route::put('/finance/update', [App\Http\Controllers\Admin\FinanceController::class, 'update'])->name('admin-finance-update');
    Route::get('/finance/delete/{id}', [App\Http\Controllers\Admin\FinanceController::class, 'destroy'])->name('admin-finance-delete');

    //LOGLOGIN
    Route::get('/loglogin', [\App\Http\Controllers\Admin\LoginLogsController::class, 'index'])->name('goto-show-loglogin');
});

Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    //USER
    //USER - SHOW
    Route::get('/admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('goto-show-dbusers');
    //USER - INSERT
    Route::get('/admin/tambahuser', [\App\Http\Controllers\Admin\UserController::class, 'showInsertUsers'])->name('goto-showinsert-dbusers');
    Route::post('/admin/tambahuser', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('goto-insert-dbusers');
    //USER - EDIT
    Route::get('/admin/edituser{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('goto-edit-dbusers');
    //USER - UPDATE
    Route::put('/admin/edituser', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('goto-update-dbusers');
    //USER - DELETE
    Route::get('/admin/user/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('goto-delete-dbusers');
    //USER - CHECK PASS
    Route::post('/admin/checkpass', [\App\Http\Controllers\Admin\UserController::class, 'checkpass'])->name('goto-checkpass-dbusers');
    //USER - DETAILS - MODAL
    Route::get('/admin/detailuser{id}', [\App\Http\Controllers\Admin\UserController::class, 'index2'])->name('goto-showdetail-dbusers');
    Route::put('admin/user{id}{status}', [\App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('goto-updateStatus-dbusers');
});

//LEAD TIM

Route::group(['middleware' => ['auth', 'checkrole:3,4']], function () {
    // LIST TASK
    // Task User
    //USER
    Route::get('/user/listtask', [App\Http\Controllers\Lead\ListtaskController::class, 'listtask'])->name('user-list-task');
    Route::get('user/task/show/{id}', [App\Http\Controllers\Lead\ListtaskController::class, 'show'])->name('user-task-show');
    Route::get('user/task/kumpul/{id}', [App\Http\Controllers\Lead\ListtaskController::class, 'edit'])->name('user-task-kumpul');
    Route::put('user/task/kumpul', [App\Http\Controllers\Lead\ListtaskController::class, 'update'])->name('user-kumpultask');
    Route::get('user/tasksearch', [App\Http\Controllers\Lead\ListtaskController::class, 'searchDate'])->name('user-search-date');
    Route::put('user/add/startdate', [\App\Http\Controllers\Lead\ListtaskController::class, 'startDate'])->name('user-start-date');
    Route::get('user/dashlistsearch', [App\Http\Controllers\Lead\ListtaskController::class, 'dashboardlist'])->name('user-dashlist-search');

    // LIST TIM
    Route::get('/listdivisi{id}', [\App\Http\Controllers\Admin\DivisionsController::class, 'listMyTeam'])->name('goto-myListTeam');
});

Route::group(['middleware' => ['auth', 'checkrole:3']], function () {
    //TASK
    //LEAD TIM
    Route::get('leadtim/task', [App\Http\Controllers\Lead\ProjectController::class, 'index'])->name('lead-task-index');
    Route::get('leadtim/task/tambahleadtask', [App\Http\Controllers\Lead\ProjectController::class, 'create'])->name('lead-task-create');
    Route::post('leadtim/task/tambahleadtask', [App\Http\Controllers\Lead\ProjectController::class, 'store'])->name('lead-task-store');
    Route::get('leadtim/task/edit/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'edit'])->name('lead-task-edit');
    Route::put('leadtim/task', [App\Http\Controllers\Lead\ProjectController::class, 'update'])->name('lead-task-update');
    Route::get('leadtim/task/single/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'singleLeadTask'])->name('lead-task-single');
    Route::get('leadtim/task/delete/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'destroy'])->name('lead-task-delete');
    Route::get('leadtim/task/detail/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'show'])->name('lead-task-show');
    Route::get('leadtim/tasksearch', [App\Http\Controllers\Lead\ProjectController::class, 'searchDateLead'])->name('lead-task-search');

    Route::put('lead/add/startDate', [\App\Http\Controllers\Lead\ProjectController::class, 'leadstartDate'])->name('lead-startDate');
    Route::get('/dashleadsearch', [App\Http\Controllers\Lead\ProjectController::class, 'dashboardlead'])->name('dashlead-search');

    Route::post('leadtim/addpic/', [App\Http\Controllers\Lead\ProjectController::class, 'storepic'])->name('lead-add-pic');
    Route::get('leadtim/pic/delete/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'destroypic'])->name('lead-task-deletepic');
    Route::get('leadtim/show/pic/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'showpic'])->name('lead-show-pic');


    //Task Lead Detail
    Route::get('leadtim/detail/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'detailTask'])->name('lead-task-detail');
    Route::put('leadtim/task/detailleadtask', [App\Http\Controllers\Lead\ProjectController::class, 'approveTask'])->name('lead-approve-task');
    Route::get('leadtim/task/approve/{id}', [App\Http\Controllers\Lead\ProjectController::class, 'approveTask2'])->name('lead-approve-task-2');
    Route::put('leadtim/task/revisi', [App\Http\Controllers\Lead\ProjectController::class, 'revisiTask'])->name('lead-revisi-task');

    // SUBTASK
    Route::get('leadtim/task/subtask/{id}', [App\Http\Controllers\Lead\SubtaskController::class, 'index'])->name('lead-subtask-single');
    Route::post('leadtim/subtask/store', [App\Http\Controllers\Lead\SubtaskController::class, 'store'])->name('lead-subtask-store');
});

Route::group(['middleware' => ['auth']], function () {
    //PROFILE
    Route::get('taskManagement/profile', [App\Http\Controllers\UserDetailsController::class, 'index'])->name('profile-profile');
    Route::get('taskManagement/profile/edit', [App\Http\Controllers\UserDetailsController::class, "edit"])->name('profile-edit');
    Route::put('taskManagement/profile', [App\Http\Controllers\UserDetailsController::class, "update"])->name('profile-update');

    //NOTES
    Route::get('notes', [App\Http\Controllers\Admin\NoteController::class, 'index'])->name('notes-index');

    // TASK NOTE
    Route::post('notes', [App\Http\Controllers\Admin\NoteController::class, 'store'])->name('notes-store');
    Route::get('notes/edit/{id}', [App\Http\Controllers\Admin\NoteController::class, 'edit'])->name('notes-edit');
    Route::put('notes', [App\Http\Controllers\Admin\NoteController::class, 'update'])->name('notes-update');
    Route::get('notes/{id}/delete', [App\Http\Controllers\Admin\NoteController::class, 'destroy'])->name('notes-delete');
});
