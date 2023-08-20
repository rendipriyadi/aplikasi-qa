<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

// request
use App\Http\Requests\InspectionMaterial\StoreInspectionMaterialRequest;
use App\Http\Requests\InspectionMaterial\UpdateInspectionMaterialRequest;

// use model here
use App\Models\Inspection\CheckMaterial;
use App\Models\Inspection\CheckTool;
use App\Models\Inspection\FileInspectionMaterial;
use App\Models\Inspection\InspectionMaterial;
use App\Models\MasterData\Satuan;
use App\Models\Transaction\MaterialSubmission;

class InspectionMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInspectionMaterialRequest $request)
    {
        // Get file material submission
        $material_submission = MaterialSubmission::where('id', $request->material_submission_id)->first();
        $no_pp = $material_submission['no_pp'];

        // upload process here
        if ($request->hasFile('file')) {
            $file = $request->file('file')->storeAs('assets/file-inspection-material', $no_pp . '-' . $request->file('file')->getClientOriginalName());
        }

        // store to database
        InspectionMaterial::create([
            'material_submission_id' => $request->material_submission_id,
            'tgl_pemeriksaan'        => $request->tgl_pemeriksaan,
            'lokasi'                 => $request->lokasi,
            'file'                   => $file,
            'keterangan'             => $request->keterangan,
            'created_by'             => $request->created_by
        ]);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.material_submission.proses', encrypt($request->material_submission_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);

        $file_inspection = FileInspectionMaterial::where('inspection_material_id', $inspection_material['id'])->get();

        return view('pages.transaksi.inspection-material.show', compact('inspection_material', 'file_inspection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proses($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);

        $check_material = CheckMaterial::where('inspection_material_id', $inspection_material['id'])->get();
        $check_tool = CheckTool::where('inspection_material_id', $inspection_material['id'])->get();
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-inspection.index', compact('inspection_material', 'check_material', 'check_tool', 'satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);

        $material_submission = MaterialSubmission::where('id', $inspection_material['material_submission_id'])->first();

        return view('pages.transaksi.inspection-material.edit', compact('inspection_material', 'material_submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInspectionMaterialRequest $request, InspectionMaterial $inspection_material)
    {
        // mencari file 
        $path_file = $inspection_material['file'];

        // Get file material submission
        $material_submission = MaterialSubmission::where('id', $inspection_material['material_submission_id'])->first();
        $no_pp = $material_submission['no_pp'];

        // update file optional
        if ($request->hasFile('file')) {
            $file = $request->file('file')->storeAs('assets/file-inspection-material', $no_pp . '-' . $request->file('file')->getClientOriginalName());
            // hapus file file
            if ($path_file != null || $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $file = $path_file;
        }

        $inspection_material->tgl_pemeriksaan = $request->tgl_pemeriksaan;
        $inspection_material->lokasi = $request->lokasi;
        $inspection_material->file = $file;
        $inspection_material->status = $request->status;
        $inspection_material->keterangan = $request->keterangan;

        $inspection_material->save();

        // upload multiple file hasil visual
        if ($request->hasFile('file_inspection')) {
            foreach ($request->file('file_inspection') as $image) {
                $file_inspection = $image->storeAs('assets/file-inspection-material', $no_pp . '-' . $image->getClientOriginalName());
                FileInspectionMaterial::create([
                    'inspection_material_id' => $inspection_material['id'],
                    'file_inspection'        => $file_inspection
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_submission.proses', encrypt($material_submission['id']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);

        // cek data 
        $check_material = CheckMaterial::where('inspection_material_id', $inspection_material['id'])->first();
        $check_tool = CheckTool::where('inspection_material_id', $inspection_material['id'])->first();

        // cek apakah data pemeriksaan_visual ada atau tidak?
        if ($check_material != null || $check_tool != null) {
            alert()->warning('Gagal', 'Data tidak bisa dihapus karena terdapat data Pemeriksaan material, dan Pemeriksaan alat silahkan hapus terlebih dahulu data tersebut');
            return back();
        } else {
            // hapus inspection_submission
            $inspection_material->delete();

            // hapus file inspection_submission
            $file_inspection = FileInspectionMaterial::where('inspection_material_id', $inspection_material['id'])->delete();

            alert()->success('Sukses', 'Data berhasil dihapus');
            return back();
        }
    }

    public function aprove(Request $request, $id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);

        $material_submission = MaterialSubmission::where('id', $inspection_material['material_submission_id'])->first();

        // jika kasi qa login 
        if (Auth::user()->detail_user->type_user_id == 4) {
            $inspection_material->aprv_kasi = $request->aprove;
            $inspection_material->save();
        }

        // jika kadep qa login
        if (Auth::user()->detail_user->type_user_id == 5) {
            $inspection_material->aprv_kadep = $request->aprove;
            $inspection_material->save();
        }

        alert()->success('Sukses', 'Data berhasil di Approve');
        return redirect()->route('backsite.material_submission.proses', encrypt($material_submission['id']));
    }

    // hapus file inspection
    public function hapus_file($id)
    {
        $file_inspection = FileInspectionMaterial::find($id);

        $file_inspection->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // print data pemeriksaan visual
    public function print($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $inspection_material = InspectionMaterial::find($decrypt_id);
        $check_material = CheckMaterial::where('inspection_material_id', $decrypt_id)->get();
        $check_tool = CheckTool::where('inspection_material_id', $decrypt_id)->get();

        // cek apakah kasi dan kadep sudah aprove
        if ($inspection_material['aprv_kasi'] == null || $inspection_material['aprv_kasi'] == '') {
            alert()->warning('Gagal', 'Kasie belum aprove data pemeriksaan visual, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.proses', encrypt($inspection_material->material_submission_id));
        } elseif ($inspection_material['aprv_kadep'] == null || $inspection_material['aprv_kadep'] == '') {
            alert()->warning('Gagal', 'Kadep belum aprove data pemeriksaan visual, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.proses', encrypt($inspection_material->material_submission_id));
        } else {
            return view('pages.report.pemeriksaan-visual.print', compact('inspection_material', 'check_material', 'check_tool'));
        }
    }
}
