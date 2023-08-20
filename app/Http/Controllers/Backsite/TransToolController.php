<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Transfer\TransTool\StoreTransToollRequest;
use App\Http\Requests\Transfer\TransTool\UpdateTransToollRequest;

// use model here
use App\Models\Transfer\TransTool;
use App\Models\MasterData\Satuan;

class TransToolController extends Controller
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
    public function store(StoreTransToollRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $trans_tool = TransTool::create($data);

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
        $trans_tool = TransTool::find($decrypt_id);

        return view('pages.transaksi.proses-transfer-material.show_tool', compact('trans_tool'));
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
        $trans_tool = TransTool::find($decrypt_id);

        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-transfer-material.edit_tool', compact('trans_tool', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransToollRequest $request, TransTool $trans_tool)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $trans_tool->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.transfer_material.proses', encrypt($trans_tool['transfer_material_id']));
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
        $trans_tool = TransTool::find($decrypt_id);

        $trans_tool->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
