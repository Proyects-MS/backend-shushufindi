<?php

use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RolePermissionController;
use App\Http\Controllers\API\StatesController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\FilesController;
use App\Http\Controllers\API\InvolucradosController;
use App\Http\Controllers\API\FolderController;
use App\Http\Controllers\API\FtpController;
use App\Http\Controllers\API\ProcessController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\TasksController;
use App\Http\Controllers\API\AssignHistoryController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\PruebaController;
use App\Http\Controllers\API\HistoryFilesController;
use App\Http\Controllers\API\ProcessTypeController;
use App\Http\Controllers\API\HiringController;
use App\Http\Controllers\API\ProcedureController;
use App\Http\Controllers\API\ProceduresSelectController;
use App\Http\Controllers\API\TemplateController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('api');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->middleware('api');

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    //Route::resource('user', UserController::class);
    Route::get('user', [UserController::class, 'index']);
    Route::get('userA', [UserController::class, 'Activos']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/Data/{id}', [UserController::class, 'update_user']);
    Route::put('user/Password/{id}', [UserController::class, 'update_password']);
    Route::put('user/Signature/{id}', [UserController::class, 'update_signature']);
    Route::post('user/Photo/{id}', [UserController::class, 'update_photo']);
    Route::put('user/Status/{id}', [UserController::class, 'update_status']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    Route::resource('roles', RoleController::class);
    Route::resource('roles_permissions', RolePermissionController::class);
    Route::resource('states', StatesController::class);
    Route::resource('files', FilesController::class);
    Route::resource('involved', InvolucradosController::class);
    Route::resource('folder', FolderController::class);
    Route::post('/ftp', [FtpController::class, 'store']);
    Route::get('/ftp/{filename}', [FtpController::class, 'show']);
    Route::post('/firma', [FtpController::class, 'firmas']);
    Route::resource('process', ProcessController::class);
    Route::resource('comments', CommentsController::class);
    Route::get('processcomments/{id}', [CommentsController::class, 'processcomment']);
    Route::get('processfiles/{id}', [FilesController::class, 'processfile']);
    Route::resource('categories', CategoriesController::class);
    Route::get('processinvolved/{id}', [InvolucradosController::class, 'processinv']);
    Route::get('processuser/{id}', [InvolucradosController::class, 'processuser']);
    Route::get('processlast/{id}', [InvolucradosController::class, 'processuserlast']);
    Route::resource('tasks', TasksController::class);
    Route::get('tasksuser/{id}/{date}', [TasksController::class, 'tasksUser']);
    Route::get('taskslast/{id}', [TasksController::class, 'tasksUserlast']);
    Route::resource('history', HistoryController::class);
    Route::resource('assignhistory', AssignHistoryController::class);
    Route::get('/roleSupervisor/{id}', [RoleController::class, 'rolesupervisor']);
    Route::put('/taskStatus/{id}', [TasksController::class, 'tasksUpdateStatus']);
    Route::put('/updURL/{id}', [FilesController::class, 'updateURL']);
    Route::get('/consulHistory/{process_id}', [AssignHistoryController::class, 'consultHis']);
    Route::post('/firmarPDF', [PruebaController::class, 'index']);
    Route::get('/HistoryProcess/{process_id}', [HistoryController::class, 'HistProcess']);
    Route::post('/HistoryFiles', [HistoryFilesController::class, 'store']);
    Route::get('/HistoryFiles/{file_id}', [HistoryFilesController::class, 'HistFiles']);
    Route::post('/SendMensaje', [PruebaController::class, 'SendMensaje']);
    Route::put('process/LastDate/{id}', [ProcessController::class, 'updateLastDate']);
    Route::get('LastSeq', [ProcessController::class, 'LastSequential']);
    Route::get('/getfileftp/{filename}', [PruebaController::class, 'file']);
    Route::resource('processtype', ProcessTypeController::class);
    Route::resource('hiring', HiringController::class);
    Route::resource('procedure', ProcedureController::class);

    Route::get('proceduresTypeSelect', [ProceduresSelectController::class, 'searchProcessType']);
    Route::get('hiringSelect/{id}', [ProceduresSelectController::class, 'searchHiring']);
    Route::get('ProcedureSelect/{id}', [ProceduresSelectController::class, 'searchProcedure']);

    //
    Route::get('template', [TemplateController::class, 'index']);
    Route::get('template/{id}', [TemplateController::class, 'show']);
    Route::post('template', [TemplateController::class, 'store']);
    Route::put('template/{id}', [TemplateController::class, 'update']);
    Route::delete('template/{id}', [TemplateController::class, 'destroy']);
});

