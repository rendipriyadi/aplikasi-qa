<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use request
use App\Http\Requests\Testing\TestTool\StoreTestToollRequest;
use App\Http\Requests\Testing\TestTool\UpdateTestToollRequest;

// use model
use App\Models\Testing\TestTool;
use App\Models\MasterData\Satuan;
use App\Models\Testing\FileTestTool;
use App\Models\Testing\MaterialTesting;

class TestToolController extends Controller
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
    public function store(StoreTestToollRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $test_tool = TestTool::create($data);

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
        $test_tool = TestTool::find($decrypt_id);

        return view('pages.transaksi.proses-testing-tool.show', compact('test_tool'));
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
        $test_tool = TestTool::find($decrypt_id);

        $satuan = Satuan::orderBy('name', 'asc')->get();

        return view('pages.transaksi.proses-testing-tool.edit', compact('satuan', 'test_tool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestToollRequest $request, TestTool $test_tool)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $test_tool->update($data);

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_testing.proses', encrypt($test_tool['material_testing_id']));
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
        $test_tool = TestTool::find($decrypt_id);

        $test_tool->delete();

        // hapus file test_material
        $file_test_tool = FileTestTool::where('test_tool_id', $test_tool['id'])->delete();

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
                $file_test = $image->storeAs('assets/file-test-tool', $no_pp . '-' . $image->getClientOriginalName());
                FileTestTool::create([
                    'test_tool_id' => $request->id,
                    'file'        => $file_test
                ]);
            }
        }

        alert()->success('Sukses', 'File Berhasil diupload');
        return redirect()->route('backsite.material_testing.proses', encrypt($request->material_testing_id));
    }

    // hapus file test tool
    public function hapus_file($id)
    {
        $file_test_tool = FileTestTool::find($id);

        $file_test_tool->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
