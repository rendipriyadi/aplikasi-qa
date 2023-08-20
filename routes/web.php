<?php

use App\Http\Controllers\Backsite\AjaxController;
use App\Http\Controllers\Backsite\CheckMaterialController;
use App\Http\Controllers\Backsite\CheckToolController;
use Illuminate\Support\Facades\Route;

// controller backsite
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\DivisiController;
use App\Http\Controllers\Backsite\InspectionMaterialController;
use App\Http\Controllers\Backsite\MaterialSubmissionController;
use App\Http\Controllers\Backsite\MaterialTestingController;
use App\Http\Controllers\Backsite\SatuanController;
use App\Http\Controllers\Backsite\TestMaterialController;
use App\Http\Controllers\Backsite\TestToolController;
use App\Http\Controllers\Backsite\TransferMaterialController;
use App\Http\Controllers\Backsite\TransMaterialController;
use App\Http\Controllers\Backsite\TransToolController;
use App\Http\Controllers\Backsite\TypeUserController;
use App\Http\Controllers\Backsite\UserController;
use App\Http\Controllers\Backsite\VendorController;
use App\Http\Controllers\ExportPf;
use Illuminate\Support\Facades\Auth;

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
    // cek apakah sudah login atau belum
    if (Auth::user() != null) {
        return redirect()->intended('backsite/dashboard');
    }

    return view('auth.login');
});

// backsite
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // ajax controller (controller bantuan)
    Route::controller(AjaxController::class)->group(function () {
        Route::post('/ajax_controller/proses', 'proses')->name('ajax_controller.proses');
        Route::post('/ajax_controller/form_upload', 'form_upload')->name('ajax_controller.form_upload');
        Route::post('/ajax_controller/form_upload_tool', 'form_upload_tool')->name('ajax_controller.form_upload_tool');
        Route::post('/ajax_controller/show_file', 'show_file')->name('ajax_controller.show_file');
        Route::post('/ajax_controller/show_file_tool', 'show_file_tool')->name('ajax_controller.show_file_tool');
        Route::post('/ajax_controller/file_inspection', 'file_inspection')->name('ajax_controller.file_inspection');
        Route::post('/ajax_controller/file_transfer_material', 'file_transfer_material')->name('ajax_controller.file_transfer_material');
        Route::post('/ajax_controller/file_material_testing', 'file_material_testing')->name('ajax_controller.file_material_testing');
    });

    // dashboard
    Route::resource('dashboard', DashboardController::class);

    // user
    Route::resource('user', UserController::class);

    // type user
    Route::resource('type_user', TypeUserController::class);

    // divisi
    Route::resource('divisi', DivisiController::class);

    // satuan
    Route::resource('satuan', SatuanController::class);

    // vendor
    Route::resource('vendor', VendorController::class);

    // Material Submission
    Route::controller(MaterialSubmissionController::class)->group(function () {
        Route::get('/material_submission/{material_submission}/edit_status', 'edit_status')->name('material_submission.edit_status');
        Route::post('material_submission/{material_submission}', 'change')->name('material_submission.change');
        Route::get('/material_submission/{material_submission}/show_status', 'show_status')->name('material_submission.show_status');
        Route::get('/material_submission/{material_submission}/proses', 'proses')->name('material_submission.proses');
        Route::get('/material_submission/{material_submission}/penyerahan', 'penyerahan')->name('material_submission.penyerahan');
        Route::get('/material_submission/{material_submission}/pengujian', 'pengujian')->name('material_submission.pengujian');
    });

    Route::resource('material_submission', MaterialSubmissionController::class);

    // Inspection Submission
    Route::controller(InspectionMaterialController::class)->group(function () {
        Route::get('/inspection_material/{inspection_material}/proses', 'proses')->name('inspection_material.proses');
        Route::post('inspection_material/{inspection_material}', 'aprove')->name('inspection_material.aprove');
        Route::delete('/inspection_material/{id}/hapus_file', 'hapus_file')->name('inspection_material.hapus_file');
        Route::get('/inspection_material/{inspection_material}/print', 'print')->name('inspection_material.print');
    });

    Route::resource('inspection_material', InspectionMaterialController::class);

    // Check Material
    Route::resource('check_material', CheckMaterialController::class);

    // Check Tool
    Route::resource('check_tool', CheckToolController::class);

    // Penyerahan
    Route::controller(TransferMaterialController::class)->group(function () {
        Route::get('/transfer_material/{transfer_material}/proses', 'proses')->name('transfer_material.proses');
        Route::post('/transfer_material/{transfer_material}', 'aprove')->name('transfer_material.aprove');
        Route::delete('/transfer_material/{id}/hapus_file', 'hapus_file')->name('transfer_material.hapus_file');
        Route::get('/transfer_material/{transfer_material}/print', 'print')->name('transfer_material.print');
    });
    Route::resource('transfer_material', TransferMaterialController::class);

    // penyerahan material
    Route::resource('trans_material', TransMaterialController::class);

    //  penyerahan tool
    Route::resource('trans_tool', TransToolController::class);

    // material testing
    Route::controller(MaterialTestingController::class)->group(function () {
        Route::get('/material_testing/{material_testing}/proses', 'proses')->name('material_testing.proses');
        Route::post('/material_testing/{material_testing}', 'aprove')->name('material_testing.aprove');
        Route::delete('/material_testing/{id}/hapus_file', 'hapus_file')->name('material_testing.hapus_file');
        Route::get('/material_testing/{material_testing}/print', 'print')->name('material_testing.print');
    });
    Route::resource('material_testing', MaterialTestingController::class);

    // test material
    Route::controller(TestMaterialController::class)->group(function () {
        Route::post('/test_material/upload', 'upload')->name('test_material.upload');
        Route::delete('/test_material/{id}/hapus_file', 'hapus_file')->name('test_material.hapus_file');
    });
    Route::resource('test_material', TestMaterialController::class);

    // test tool
    Route::controller(TestToolController::class)->group(function () {
        Route::post('/test_tool/upload', 'upload')->name('test_tool.upload');
        Route::delete('/test_tool/{id}/hapus_file', 'hapus_file')->name('test_tool.hapus_file');
    });
    Route::resource('test_tool', TestToolController::class);
});
