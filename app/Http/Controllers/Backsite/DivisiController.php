<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// request
use App\Http\Requests\Divisi\StoreDivisiRequest;
use App\Http\Requests\Divisi\UpdateDivisiRequest;

// use model here
use App\Models\MasterData\Divisi;
use Illuminate\Support\Facades\Hash;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisi = Divisi::orderBy('name', 'asc')->get();

        return view('pages.master-data.divisi.index', compact('divisi'));
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
    public function store(StoreDivisiRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $divisi = Divisi::create($data);

        alert()->success('Sukses', 'Divisi berhasil ditambahkan');
        return redirect()->route('backsite.divisi.index');
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
        $divisi = Divisi::find($decrypt_id);

        return view('pages.master-data.divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDivisiRequest $request, Divisi $divisi)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $divisi->update($data);

        alert()->success('Sukses', 'Divisi berhasil diupdate');
        return redirect()->route('backsite.divisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deksripsi id
        $decrypt_id = decrypt($id);
        $divisi = Divisi::find($decrypt_id);

        // hapus divisi
        $divisi->forceDelete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
