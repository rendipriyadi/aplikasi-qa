<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Transfer\TransMaterial\StoreTransMaterialRequest;
use App\Http\Requests\Transfer\TransMaterial\UpdateTransMaterialRequest;

// use model here
use App\Models\Transfer\TransMaterial;
use App\Models\Inspection\CheckMaterial;
use App\Models\MasterData\Satuan;

class TransMaterialController extends Controller
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
    public function store(StoreTransMaterialRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $trans_material = TransMaterial::create($data);

        alert()->success('Sukses', 'Data berhasil ditambahkan');
        return redirect()->route('backsite.transfer_material.proses', encrypt($request->transfer_material_id));
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
        $trans_material = TransMaterial::find($decrypt_id);

        return view('pages.transaksi.proses-transfer-material.show_material', compact('trans_material'));
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
        $trans_material = TransMaterial::find($decrypt_id);

        $check_material = CheckMaterial::where('inspection_material_id', $trans_material->transfer_material['inspection_material_id'])->get();
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-transfer-material.edit_material', compact('trans_material', 'check_material', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransMaterialRequest $request, TransMaterial $trans_material)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $trans_material->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.transfer_material.proses', encrypt($trans_material['transfer_material_id']));
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
        $trans_material = TransMaterial::find($decrypt_id);

        $trans_material->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
