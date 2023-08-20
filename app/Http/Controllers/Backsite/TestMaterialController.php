<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Testing\TestMaterial\StoreTestMaterialRequest;
use App\Http\Requests\Testing\TestMaterial\UpdateTestMaterialRequest;

// use model here
use App\Models\Inspection\CheckMaterial;
use App\Models\MasterData\Satuan;
use App\Models\Testing\FileTestMaterial;
use App\Models\Testing\MaterialTesting;
use App\Models\Testing\TestMaterial;

// use library here
use Illuminate\Support\Facades\Storage;

class TestMaterialController extends Controller
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
    public function store(StoreTestMaterialRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $test_material = TestMaterial::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.material_testing.proses', encrypt($request->material_testing_id));
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
        $test_material = TestMaterial::find($decrypt_id);

        return view('pages.transaksi.proses-testing-material.show', compact('test_material'));
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
        $test_material = TestMaterial::find($decrypt_id);

        $check_material = CheckMaterial::where('inspection_material_id', $test_material->material_testing->transfer_material['inspection_material_id'])->get();
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-testing-material.edit', compact('check_material', 'test_material', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestMaterialRequest $request, TestMaterial $test_material)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $test_material->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_testing.proses', encrypt($test_material['material_testing_id']));
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
        $test_material = TestMaterial::find($decrypt_id);

        $test_material->delete();

        // hapus file test_material
        $file_test_material = FileTestMaterial::where('test_material_id', $test_material['id'])->delete();
        // $file_test_material->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // upload file
    public function upload(Request $request)
    {
        // Get material testing
        $material_testing = MaterialTesting::where('id',  $request->material_testing_id)->first();
        $no_pp =  $material_testing->material_submission['no_pp'];

        // save to file test material
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $file_test = $image->storeAs('assets/file-test-material', $no_pp . '-' . $image->getClientOriginalName());
                FileTestMaterial::create([
                    'test_material_id' => $request->id,
                    'file'        => $file_test
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.material_testing.proses', encrypt($request->material_testing_id));
    }

    // hapus file test material
    public function hapus_file($id)
    {
        $file_test_material = FileTestMaterial::find($id);

        $file_test_material->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
