<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use model here
use App\Models\Inspection\CheckMaterial;
use App\Models\Inspection\FileInspectionMaterial;
use App\Models\Testing\FileMaterialTesting;
use App\Models\Testing\FileTestMaterial;
use App\Models\Testing\FileTestTool;
use App\Models\Testing\TestMaterial;
use App\Models\Testing\TestTool;
use App\Models\Transfer\FileTransferMaterial;

class AjaxController extends Controller
{
    // get data check material
    public function proses(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id_test;
            $check_material = CheckMaterial::where('id', $id)->first();

            if ($check_material == null || $check_material == '') {
                $msg = [
                    'error' => 'Data tidak ditemukan'
                ];
            } else {
                $data = [
                    'sumber' => $check_material['sumber'],
                ];
                $msg = [
                    'sukses' => $data,
                ];
            }

            return response()->json($msg);
        }
    }

    // get form upload file test material
    public function form_upload(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = TestMaterial::find($id);
            $data = [
                'id' => $row['id'],
                'material_testing_id' => $row['material_testing_id']
            ];

            $msg = [
                'data' => view('pages.transaksi.proses-testing-material.upload_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get form upload file test tool
    public function form_upload_tool(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $row = TestTool::find($id);
            $data = [
                'id' => $row['id'],
                'material_testing_id' => $row['material_testing_id']
            ];

            $msg = [
                'data' => view('pages.transaksi.proses-testing-tool.upload_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get show_file test material
    public function show_file(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $file_test_material = FileTestMaterial::where('test_material_id', $id)->get();
            $data = [
                'datafile' => $file_test_material
            ];

            $msg = [
                'data' => view('pages.transaksi.proses-testing-material.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get show_file test tool
    public function show_file_tool(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $file_test_tool = FileTestTool::where('test_tool_id', $id)->get();
            $data = [
                'datafile' => $file_test_tool
            ];

            $msg = [
                'data' => view('pages.transaksi.proses-testing-tool.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get file_inspection
    public function file_inspection(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $file_inspection = FileInspectionMaterial::where('inspection_material_id', $id)->get();
            $data = [
                'datafile' => $file_inspection
            ];

            $msg = [
                'data' => view('pages.transaksi.inspection-material.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get file_transfer_material
    public function file_transfer_material(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $file_transfer_material = FileTransferMaterial::where('transfer_material_id', $id)->get();
            $data = [
                'datafile' =>  $file_transfer_material
            ];

            $msg = [
                'data' => view('pages.transaksi.transfer-material.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }

    // get file_material_testing
    public function file_material_testing(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $file_material_testing = FileMaterialTesting::where('material_testing_id', $id)->get();
            $data = [
                'datafile' => $file_material_testing
            ];

            $msg = [
                'data' => view('pages.transaksi.material-testing.detail_file', $data)->render()
            ];

            return response()->json($msg);
        }
    }
}
