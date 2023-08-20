<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\CheckMaterial\StoreCheckMaterialRequest;
use App\Http\Requests\CheckMaterial\UpdateCheckMaterialRequest;

// use model here
use App\Models\Inspection\CheckMaterial;
use App\Models\MasterData\Satuan;

class CheckMaterialController extends Controller
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
    public function store(StoreCheckMaterialRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $check_material = CheckMaterial::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.inspection_material.proses', encrypt($request->inspection_material_id));
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
        $check_material = CheckMaterial::find($decrypt_id);

        return view('pages.transaksi.proses-inspection.show_material', compact('check_material'));
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
        $check_material = CheckMaterial::find($decrypt_id);

        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-inspection.edit_material', compact('check_material', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCheckMaterialRequest $request, CheckMaterial $check_material)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $check_material->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.inspection_material.proses', encrypt($check_material->inspection_material_id));
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
        $check_material = CheckMaterial::find($decrypt_id);

        // hapus data
        $check_material->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
