<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Testing\MaterialTesting\StoreMaterialTestingRequest;
use App\Http\Requests\Testing\MaterialTesting\UpdateMaterialTestingRequest;

// use model here
use App\Models\Testing\MaterialTesting;
use App\Models\Transaction\MaterialSubmission;
use App\Models\Inspection\InspectionMaterial;
use App\Models\MasterData\Satuan;
use App\Models\Testing\TestMaterial;
use App\Models\Inspection\CheckMaterial;
use App\Models\Testing\FileMaterialTesting;
use App\Models\Testing\TestTool;

// use library here
use Illuminate\Support\Facades\Auth;

class MaterialTestingController extends Controller
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
    public function store(StoreMaterialTestingRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $material_testing = MaterialTesting::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.material_submission.pengujian', encrypt($request->material_submission_id));
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
        $material_testing = MaterialTesting::find($decrypt_id);

        return view('pages.transaksi.material-testing.show', compact('material_testing'));
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
        $material_testing = MaterialTesting::find($decrypt_id);

        $material_submission = MaterialSubmission::where('id', $material_testing['material_submission_id'])->first();
        $inspection_material = InspectionMaterial::where('id', $material_testing['inspection_material_id'])->first();

        return view('pages.transaksi.material-testing.edit', compact('material_testing', 'inspection_material', 'material_submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaterialTestingRequest $request, MaterialTesting $material_testing)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $material_testing->update($data);

        $material_submission = MaterialSubmission::where('id',  $material_testing['material_submission_id'])->first();
        $no_pp = $material_submission['no_pp'];

        // upload multiple file hasil visual
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file_testing = $image->storeAs('assets/file-material-testing', $no_pp . '-' . $image->getClientOriginalName());
                FileMaterialTesting::create([
                    'material_testing_id' => $material_testing->id,
                    'file'        => $file_testing
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_submission.pengujian', encrypt($material_testing->material_submission_id));
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
        $material_testing = MaterialTesting::find($decrypt_id);

        // cek data
        $test_material = TestMaterial::where('material_testing_id', $material_testing['id'])->first();
        $test_tool = TestTool::where('material_testing_id', $material_testing['id'])->first();

        // cek apakah data pemeriksaan_visual ada atau tidak?
        if ($test_material != null || $test_tool != null) {
            alert()->warning('Gagal', 'Data tidak bisa dihapus karena terdapat data Pengujian material, dan Pengujian alat silahkan hapus terlebih dahulu data tersebut');
            return back();
        } else {
            // hapus material_submission
            $material_testing->delete();

            // hapus file inspection_submission
            $file_material_testing = FileMaterialTesting::where('material_testing_id', $material_testing['id'])->delete();

            alert()->success('Sukses', 'Data berhasil dihapus');
            return back();
        }
    }

    public function proses($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_testing = MaterialTesting::find($decrypt_id);

        $check_material = CheckMaterial::where('inspection_material_id', $material_testing->transfer_material['inspection_material_id'])->get();
        $test_material = TestMaterial::where('material_testing_id', $material_testing['id'])->get();
        $test_tool = TestTool::where('material_testing_id', $material_testing['id'])->get();
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-testing-material.index', compact('material_testing', 'check_material', 'test_material', 'satuan', 'test_tool'));
    }

    public function aprove(Request $request, $id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_testing = MaterialTesting::find($decrypt_id);

        // jika kasi qa login 
        if (Auth::user()->detail_user->type_user_id == 4) {
            $material_testing->aprv_kasi = $request->aprove;
            $material_testing->save();
        }

        // jika kadep qa login
        if (Auth::user()->detail_user->type_user_id == 5) {
            $material_testing->aprv_kadep = $request->aprove;
            $material_testing->save();
        }

        alert()->success('Sukses', 'Data berhasil di Approve');
        return redirect()->route('backsite.material_submission.pengujian', encrypt($material_testing->material_submission_id));
    }


    // hapus file material testing
    public function hapus_file($id)
    {
        $file_material_testing = FileMaterialTesting::find($id);

        $file_material_testing->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // print data pemeriksaan visual
    public function print($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_testing = MaterialTesting::find($decrypt_id);
        $test_material = TestMaterial::where('material_testing_id', $decrypt_id)->get();
        $test_tool = TestTool::where('material_testing_id', $decrypt_id)->get();

        // cek apakah kasi dan kadep sudah aprove
        if ($material_testing['aprv_kasi'] == null ||  $material_testing['aprv_kasi'] == '') {
            alert()->warning('Gagal', 'Kasie belum aprove data pengujian, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.pengujian', encrypt($material_testing->material_submission_id));
        } elseif ($material_testing['aprv_kadep'] == null ||  $material_testing['aprv_kadep'] == '') {
            alert()->warning('Gagal', 'Kadep belum aprove data pengujian, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.pengujian', encrypt($material_testing->material_submission_id));
        } else {
            return view('pages.report.pengujian.print', compact('material_testing', 'test_material', 'test_tool'));
        }
    }
}
