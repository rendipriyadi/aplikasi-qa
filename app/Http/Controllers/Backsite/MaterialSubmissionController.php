<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use library here
use Illuminate\Support\Facades\Storage;

// request
use App\Http\Requests\MaterialSubmission\StoreMaterialSubmissionRequest;
use App\Http\Requests\MaterialSubmission\UpdateMaterialSubmissionRequest;
use App\Http\Requests\MaterialSubmission\ChangeMaterialSubmissionRequest;

// use everything here
use Illuminate\Support\Facades\Crypt;

// use model here
use App\Models\MasterData\Divisi;
use App\Models\MasterData\Vendor;
use App\Models\Inspection\InspectionMaterial;
use App\Models\Testing\MaterialTesting;
use App\Models\Transaction\FileMaterialSubmission;
use App\Models\Transaction\MaterialSubmission;
use App\Models\Transaction\StatusMaterialSubmission;
use App\Models\Transfer\TransferMaterial;

class MaterialSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material_submission = MaterialSubmission::orderByRaw('no_pp, created_at DESC')->get();
        $vendor = Vendor::orderBy('name', 'asc')->get();
        $divisi = Divisi::orderBy('name', 'asc')->get();

        return view('pages.transaksi.material-submission.index', compact('material_submission', 'vendor', 'divisi'));
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
    public function store(StoreMaterialSubmissionRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // convert array jenis_pemeriksaan
        $data['jenis_pemeriksaan'] = json_encode($request->jenis_pemeriksaan);

        // store to database
        $material_submission = MaterialSubmission::create($data);

        // upload process file material submission
        if ($request->hasFile('pcm')) {
            $pcm = $request->file('pcm')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('pcm')->getClientOriginalName());
        }

        if ($request->hasFile('kak')) {
            $kak = $request->file('kak')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('kak')->getClientOriginalName());
        }

        if ($request->hasFile('brosur')) {
            $brosur = $request->file('brosur')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('brosur')->getClientOriginalName());
        }

        if ($request->hasFile('file_lain')) {
            $file_lain = $request->file('file_lain')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('file_lain')->getClientOriginalName());
        } else {
            $file_lain = '';
        }

        // save to file material , to set material_submission_id
        FileMaterialSubmission::create([
            'material_submission_id'        => $material_submission['id'],
            'pcm'                           => $pcm,
            'kak'                           => $kak,
            'brosur'                        => $brosur,
            'file_lain'                     => $file_lain,
            'keterangan'                    => $request->catatan,
        ]);

        // save to status material , to set material_submission_id
        StatusMaterialSubmission::create([
            'material_submission_id'        => $material_submission['id'],
        ]);

        alert()->success('Sukses', 'Berhasil mengajukan permohonan material, silahkan menunggu konfirmasi dari Staff QA');
        return redirect()->route('backsite.material_submission.index');
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
        $material_submission = MaterialSubmission::find($decrypt_id);

        $file_material = FileMaterialSubmission::where('material_submission_id', $material_submission['id'])->get();

        return view('pages.transaksi.material-submission.show', compact('material_submission', 'file_material'));
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
        $material_submission = MaterialSubmission::find($decrypt_id);

        $vendor = Vendor::orderBy('name', 'asc')->get();
        $divisi = Divisi::orderBy('name', 'asc')->get();

        return view('pages.transaksi.material-submission.edit', compact('material_submission', 'vendor', 'divisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaterialSubmissionRequest $request, MaterialSubmission $material_submission)
    {
        // cek data pengujian ada atau tidak
        $pengujian = MaterialTesting::where('material_submission_id', $material_submission['id'])->first();

        // Get file material submission
        $file_material = FileMaterialSubmission::where('material_submission_id', $material_submission['id'])->first();

        // mencari file 
        $path_kak = $file_material['kak'];
        $path_pcm = $file_material['pcm'];
        $path_brosur = $file_material['brosur'];
        $path_file_lain = $file_material['file_lain'];

        // jika pengujian tidak ada
        if ($pengujian == null) {
            // maka hanya update material submission
            // get all request from frontsite
            $data = $request->all();

            // convert array jenis_pemeriksaan
            $data['jenis_pemeriksaan'] = json_encode($request->jenis_pemeriksaan);

            // update to database
            $material_submission->update($data);

            // update file optional
            if ($request->hasFile('pcm')) {
                $pcm = $request->file('pcm')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('pcm')->getClientOriginalName());
                // hapus file pcm
                if ($path_pcm != null || $path_pcm != '') {
                    Storage::delete($path_pcm);
                }
            } else {
                $pcm = $path_pcm;
            }

            if ($request->hasFile('kak')) {
                $kak = $request->file('kak')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('kak')->getClientOriginalName());
                // hapus file kak
                if ($path_kak != null || $path_kak != '') {
                    Storage::delete($path_kak);
                }
            } else {
                $kak = $path_kak;
            }

            if ($request->hasFile('brosur')) {
                $brosur = $request->file('brosur')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('brosur')->getClientOriginalName());
                // hapus file brosur
                if ($path_brosur != null || $path_brosur != '') {
                    Storage::delete($path_brosur);
                }
            } else {
                $brosur = $path_brosur;
            }

            if ($request->hasFile('file_lain')) {
                $file_lain = $request->file('file_lain')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('file_lain')->getClientOriginalName());
                // hapus file_lain
                if ($path_file_lain != null || $path_file_lain != '') {
                    Storage::delete($path_file_lain);
                }
            } else {
                $file_lain = $path_file_lain;
            }

            if ($request->hasFile('brosur_lain')) {
                $brosur_lain = $request->file('brosur_lain')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('brosur_lain')->getClientOriginalName());

                // save to file material , to set material_submission_id
                FileMaterialSubmission::create([
                    'material_submission_id'        => $material_submission['id'],
                    'brosur'                        => $brosur_lain,
                ]);
            }

            $file_material->pcm = $pcm;
            $file_material->kak = $kak;
            $file_material->brosur = $brosur;
            $file_material->file_lain = $file_lain;
            $file_material->keterangan = $request->catatan;

            $file_material->save();
        }

        // jika pengujian ada
        if ($pengujian != null) {
            $status_pengujian = $pengujian->status;
            // cek status pengujian sesuai atau tidak
            if ($status_pengujian == 2) {
                // get all request from frontsite
                $data = $request->all();

                // convert array jenis_pemeriksaan
                $data['jenis_pemeriksaan'] = json_encode($request->jenis_pemeriksaan);

                // store to database
                $material_submission = MaterialSubmission::create($data);

                // update file optional
                if ($request->hasFile('pcm')) {
                    $pcm = $request->file('pcm')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('pcm')->getClientOriginalName());
                } else {
                    $pcm = $path_pcm;
                }

                if ($request->hasFile('kak')) {
                    $kak = $request->file('kak')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('kak')->getClientOriginalName());
                } else {
                    $kak = $path_kak;
                }

                if ($request->hasFile('brosur')) {
                    $brosur = $request->file('brosur')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('brosur')->getClientOriginalName());
                } else {
                    $brosur = $path_brosur;
                }

                if ($request->hasFile('file_lain')) {
                    $file_lain = $request->file('file_lain')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('file_lain')->getClientOriginalName());
                } else {
                    $file_lain = $path_file_lain;
                }

                // save to file material , to set material_submission_id
                FileMaterialSubmission::create([
                    'material_submission_id'        => $material_submission['id'],
                    'pcm'                           => $pcm,
                    'kak'                           => $kak,
                    'brosur'                        => $brosur,
                    'file_lain'                     => $file_lain,
                    'keterangan'                    => $request->catatan,
                ]);

                // cek apakah ada tambah brosur lain
                if ($request->hasFile('brosur_lain')) {
                    $brosur_lain = $request->file('brosur_lain')->storeAs('assets/file-material-submission', $request->no_pp . '-' . $request->file('brosur_lain')->getClientOriginalName());

                    // save to file material , to set material_submission_id
                    FileMaterialSubmission::create([
                        'material_submission_id'        => $material_submission['id'],
                        'brosur'                        => $brosur_lain,
                    ]);
                }

                // save to status material , to set material_submission_id
                StatusMaterialSubmission::create([
                    'material_submission_id'        => $material_submission['id'],
                ]);
            }
        }

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_submission.index');
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
        $material_submission = MaterialSubmission::find($decrypt_id);

        // cek data
        $pemeriksaan_visual = InspectionMaterial::where('material_submission_id', $material_submission['id'])->first();
        $transfer_material = TransferMaterial::where('material_submission_id', $material_submission['id'])->first();
        $material_testing = MaterialTesting::where('material_submission_id', $material_submission['id'])->first();

        // cek apakah data pemeriksaan_visual ada atau tidak?
        if ($pemeriksaan_visual != null || $transfer_material != null || $material_testing != null) {
            alert()->warning('Gagal', 'Data tidak bisa dihapus karena terdapat data Pemeriksaan visual, Pembuatan benda uji/pendaftaran lab, dan Pengujian silahkan hapus terlebih dahulu data tersebut');
            return back();
        } else {
            // hapus material_submission
            $material_submission->delete();

            // Hapus file material submission
            $file_material = FileMaterialSubmission::where('material_submission_id', $material_submission['id'])->first();

            if ($file_material != null || $file_material != '') {
                $file_material->delete();
            }

            // Hapus status material submission
            $status_material = StatusMaterialSubmission::where('material_submission_id', $material_submission['id'])->first();

            if ($status_material != null ||  $status_material != '') {
                $status_material->delete();
            }

            alert()->success('Sukses', 'Data berhasil dihapus');
            return back();
        }
    }

    public function edit_status($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_submission = MaterialSubmission::find($decrypt_id);

        return view('pages.transaksi.status-material.update_status', compact('material_submission'));
    }

    public function change(ChangeMaterialSubmissionRequest $request, MaterialSubmission $material_submission)
    {
        // get all request from frontsite
        $id = $request->id;
        $status = $request->status;

        // update to database
        $material_submission = MaterialSubmission::find($id);
        $material_submission->status = $status;
        $material_submission->save();

        // Get status material submission
        $status_material = StatusMaterialSubmission::where('material_submission_id', $id)->first();

        $no_pp = $material_submission['no_pp'];

        $path_file = $status_material['file'];
        // upload process here
        if ($request->hasFile('file')) {
            $file = $request->file('file')->storeAs('assets/status-material-submission', $no_pp . '-' . $request->file('file')->getClientOriginalName());
            // hapus file_lain
            if ($path_file != null ||  $path_file != '') {
                Storage::delete($path_file);
            }
        } else {
            $file = $path_file;
        }

        // update status material
        $status_material->file = $file;
        $status_material->keterangan = $request->keterangan;
        $status_material->save();

        alert()->success('Sukses', 'Data berhasil diupdate');
        return redirect()->route('backsite.material_submission.index');
    }

    // status material
    public function show_status($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_submission = MaterialSubmission::find($decrypt_id);

        return view('pages.transaksi.status-material.show_status', compact('material_submission'));
    }

    // pemeriksaan visual
    public function proses($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_submission = MaterialSubmission::find($decrypt_id);

        $inspection_material = InspectionMaterial::where('material_submission_id', $decrypt_id)->orderBy('created_at', 'desc')->get();

        return view('pages.transaksi.inspection-material.index', compact('material_submission', 'inspection_material'));
    }

    // penyerahan
    public function penyerahan($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_submission = MaterialSubmission::find($decrypt_id);

        $inspection_material = InspectionMaterial::where('material_submission_id', $material_submission['id'])->orderBy('created_at', 'desc')->first();
        $transfer_material = TransferMaterial::where('material_submission_id', $material_submission['id'])->orderBy('created_at', 'desc')->get();

        // cek apakah kasi dan kadep sudah aprove
        if ($inspection_material['aprv_kasi'] == null || $inspection_material['aprv_kasi'] == '') {
            alert()->warning('Gagal', 'Kasie belum aprove data pemeriksaan visual, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.index');
        } elseif ($inspection_material['aprv_kadep'] == null || $inspection_material['aprv_kadep'] == '') {
            alert()->warning('Gagal', 'Kadep belum aprove data pemeriksaan visual, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.index');
        } else {
            return view('pages.transaksi.transfer-material.index', compact('material_submission', 'inspection_material', 'transfer_material'));
        }
    }

    // pengujian
    public function pengujian($id)
    {
        // deskripsi id
        $decrypt_id = decrypt($id);
        $material_submission = MaterialSubmission::find($decrypt_id);

        $transfer_material = TransferMaterial::where('material_submission_id', $material_submission['id'])->orderBy('created_at', 'desc')->first();
        $material_testing = MaterialTesting::where('material_submission_id', $material_submission['id'])->orderBy('created_at', 'desc')->get();

        // cek apakah kasi dan kadep sudah aprove
        if ($transfer_material['aprv_kasi'] == null || $transfer_material['aprv_kasi'] == '') {
            alert()->warning('Gagal', 'Kasie belum aprove data pembuatan benda uji/pendaftaran lab, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.index');
        } elseif ($transfer_material['aprv_kadep'] == null || $transfer_material['aprv_kadep'] == '') {
            alert()->warning('Gagal', 'Kadep belum aprove data pembuatan benda uji/pendaftaran lab, Silahkan di aprove terlebih dahulu');
            return redirect()->route('backsite.material_submission.index');
        } else {
            return view('pages.transaksi.material-testing.index ', compact('material_submission', 'transfer_material', 'material_testing'));
        }
    }
}
