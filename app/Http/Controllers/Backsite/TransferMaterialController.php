<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Transfer\TransferMaterial\StoreTransferMaterialRequest;
use App\Http\Requests\Transfer\TransferMaterial\UpdateTransferMaterialRequest;

// use model here
use App\Models\Transfer\TransferMaterial;
use App\Models\Inspection\InspectionMaterial;
use App\Models\MasterData\Satuan;
use App\Models\Transaction\MaterialSubmission;
use App\Models\Transfer\FileTransferMaterial;
use App\Models\Transfer\TransMaterial;
use App\Models\Transfer\TransTool;
use App\Models\Inspection\CheckMaterial;

// use library here
use Illuminate\Support\Facades\Auth;

class TransferMaterialController extends Controller
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
    public function store(StoreTransferMaterialRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $transfer_material = TransferMaterial::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.material_submission.penyerahan', encrypt($request->material_submission_id));
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
        $transfer_material = TransferMaterial::find($decrypt_id);

        return view('pages.transaksi.transfer-material.show', compact('transfer_material'));
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
        $transfer_material = TransferMaterial::find($decrypt_id);

        $material_submission = MaterialSubmission::where('id', $transfer_material['material_submission_id'])->first();
        $inspection_material = InspectionMaterial::where('id', $transfer_material['inspection_material_id'])->first();

        return view('pages.transaksi.transfer-material.edit', compact('transfer_material', 'inspection_material', 'material_submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferMaterialRequest $request, TransferMaterial $transfer_material)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $transfer_material->update($data);

        $material_submission = MaterialSubmission::where('id',  $transfer_material['material_submission_id'])->first();
        $no_pp = $material_submission['no_pp'];

        // upload multiple file hasil visual
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file_testing = $image->storeAs('assets/file-transfer-material', $no_pp . '-' . $image->getClientOriginalName());
                FileTransferMaterial::create([
                    'transfer_material_id' => $transfer_material->id,
                    'file'        => $file_testing
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_submission.penyerahan', encrypt($transfer_material->material_submission_id));
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
        $transfer_material = TransferMaterial::find($decrypt_id);

        // cek data 
        $trans_material = TransMaterial::where('transfer_material_id', $transfer_material['id'])->first();
        $trans_tool = TransTool::where('transfer_material_id', $transfer_material['id'])->first();

        // cek apakah data pemeriksaan_visual ada atau tidak?
        if ($trans_material != null || $trans_tool != null) {
            alert()->warning('Gagal', 'Data tidak bisa dihapus karena terdapat data Pembuatan benda uji/pendaftaran lab, silahkan hapus terlebih dahulu data tersebut');
            return back();
        } else {
            // hapus material_submission
            $transfer_material->delete();

            // hapus file inspection_submission
            $file_transfer_material = FileTransferMaterial::where('transfer_material_id', $transfer_material['id'])->delete();

            alert()->success('Sukses', 'Data berhasil dihapus');
            return back();
        }
    }

    // hapus file transfer material
    public function hapus_file($id)
    {
        $file_transfer_material = FileTransferMaterial::find($id);

        $file_transfer_material->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    public function proses($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $transfer_material = TransferMaterial::find($decrypt_id);

        $check_material = CheckMaterial::where('inspection_material_id', $transfer_material['inspection_material_id'])->get();
        $trans_material = TransMaterial::where('transfer_material_id', $transfer_material['id'])->get();
        $trans_tool = TransTool::where('transfer_material_id', $transfer_material['id'])->get();
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-transfer-material.index', compact('transfer_material', 'check_material', 'trans_material', 'satuan', 'trans_tool'));
    }

    public function aprove(Request $request, $id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $transfer_material = TransferMaterial::find($decrypt_id);

        // jika kasi qa login 
        if (Auth::user()->detail_user->type_user_id == 4) {
            $transfer_material->aprv_kasi = $request->aprove;
            $transfer_material->save();
        }

        // jika kadep qa login
        if (Auth::user()->detail_user->type_user_id == 5) {
            $transfer_material->aprv_kadep = $request->aprove;
            $transfer_material->save();
        }

        alert()->success('Sukses', 'Data berhasil di Approve');
        return redirect()->route('backsite.material_submission.penyerahan', encrypt($transfer_material->material_submission_id));
    }

    // print data pemeriksaan visual
    public function print($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $transfer_material = TransferMaterial::find($decrypt_id);
        $trans_material = TransMaterial::where('transfer_material_id', $decrypt_id)->get();
        $trans_tool = TransTool::where('transfer_material_id', $decrypt_id)->get();

        // cek apakah kasi dan kadep sudah aprove
        if ($transfer_material['aprv_kasi'] == null ||  $transfer_material['aprv_kasi'] == '') {
            alert()->warning('Gagal', 'Kasie belum aprove data ppembuatan benda uji/pendaftaran lab, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.penyerahan', encrypt($transfer_material->material_submission_id));
        } elseif ($transfer_material['aprv_kadep'] == null ||  $transfer_material['aprv_kadep'] == '') {
            alert()->warning('Gagal', 'Kadep belum aprove data ppembuatan benda uji/pendaftaran lab, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.penyerahan', encrypt($transfer_material->material_submission_id));
        } else {
            return view('pages.report.penyerahan.print', compact('transfer_material', 'trans_material', 'trans_tool'));
        }
    }
}
