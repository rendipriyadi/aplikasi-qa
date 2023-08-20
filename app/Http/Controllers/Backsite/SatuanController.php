<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Satuan\StoreSatuanRequest;
use App\Http\Requests\Satuan\UpdateSatuanRequest;

// use model here
use App\Models\MasterData\Satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.master-data.satuan.index', compact('satuan'));
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
    public function store(StoreSatuanRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $satuan = Satuan::create($data);

        alert()->success('Sukses', 'Satuan berhasil ditambahkan');
        return redirect()->route('backsite.satuan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
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
        $satuan = Satuan::find($decrypt_id);

        return view('pages.master-data.satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSatuanRequest $request, Satuan $satuan)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $satuan->update($data);

        alert()->success('Sukses', 'Satuan berhasil diupdate');
        return redirect()->route('backsite.satuan.index');
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
        $satuan = Satuan::find($decrypt_id);

        // hapus satuan
        $satuan->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
