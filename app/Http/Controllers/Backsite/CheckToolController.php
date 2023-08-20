<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\CheckTool\StoreCheckToolRequest;
use App\Http\Requests\CheckTool\UpdateCheckToolRequest;

// use model here
use App\Models\Inspection\CheckTool;
use App\Models\MasterData\Satuan;

class CheckToolController extends Controller
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
    public function store(StoreCheckToolRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $check_tool = CheckTool::create($data);

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
        $check_tool = CheckTool::find($decrypt_id);

        return view('pages.transaksi.proses-inspection.show_tool', compact('check_tool'));
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
        $check_tool = CheckTool::find($decrypt_id);

        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-inspection.edit_tool', compact('check_tool', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCheckToolRequest $request, CheckTool $check_tool)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $check_tool->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.inspection_material.proses', encrypt($check_tool->inspection_material_id));
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
        $check_tool = CheckTool::find($decrypt_id);

        // hapus data
        $check_tool->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
