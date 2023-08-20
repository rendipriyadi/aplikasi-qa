@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Permohonan Material')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Permohonan QA</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Permohonan QA</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_submission.index') }}">kembali</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>Isi input <code>required</code>, Sebelum menekan tombol submit. </p>
                                        </div>

                                        <form class="form"
                                            action="{{ route('backsite.material_submission.update', [$material_submission->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_pp">No PP <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_pp" name="no_pp"
                                                            class="form-control border-primary"
                                                            value="{{ old('no_pp', isset($material_submission) ? $material_submission->no_pp : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('no_pp'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_pp') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="no_permohonan">No Permohonan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_permohonan" name="no_permohonan"
                                                            class="form-control border-primary"
                                                            value="{{ old('no_permohonan', isset($material_submission) ? $material_submission->no_permohonan : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('no_permohonan'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_permohonan') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_kontrak">No Kontrak <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_kontrak" name="no_kontrak"
                                                            class="form-control border-primary"
                                                            value="{{ old('no_kontrak', isset($material_submission) ? $material_submission->no_kontrak : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('no_kontrak'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('no_kontrak') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="no_pp">Tgl Permohonan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="tgl_permohonan" name="tgl_permohonan"
                                                            class="form-control"
                                                            value="{{ old('tgl_permohonan', isset($material_submission) ? $material_submission->tgl_permohonan : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('tgl_permohonan'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('tgl_permohonan') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control">Kontraktor Pelaksana <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="vendor_id" id="vendor_id" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>Choose
                                                            </option>
                                                            @foreach ($vendor as $key => $vendor_item)
                                                                <option value="{{ $vendor_item->id }}"
                                                                    {{ $vendor_item->id == $material_submission->vendor_id ? 'selected' : '' }}>
                                                                    {{ $vendor_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('vendor_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('vendor_id') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control">Unit Kerja <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="divisi_id" id="divisi_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>Choose
                                                            </option>
                                                            @foreach ($divisi as $divisi => $divisi_item)
                                                                <option value="{{ $divisi_item->id }}"
                                                                    {{ $divisi_item->id == $material_submission->divisi_id ? 'selected' : '' }}>
                                                                    {{ $divisi_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('divisi_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('divisi_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jenis_pekerjaan">Jenis
                                                        Pekerjaan<code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <textarea rows="5" class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan" required>{{ isset($material_submission->jenis_pekerjaan) ? $material_submission->jenis_pekerjaan : 'N/A' }}</textarea>
                                                    </div>
                                                    <label class="col-md-2 label-control">Jenis Pemeriksaan <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <label for="role">
                                                            <span
                                                                class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                            <span
                                                                class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                        </label>

                                                        <select name="jenis_pemeriksaan[]" id="role"
                                                            class="form-control select2-full-bg" data-bgcolor="teal"
                                                            data-bgcolor-variation="lighten-3" data-text-color="black"
                                                            multiple="multiple" required>
                                                            @php
                                                                $jenis_pemeriksaan = json_decode($material_submission->jenis_pemeriksaan);
                                                            @endphp
                                                            <option value="1"
                                                                {{ in_array('1', $jenis_pemeriksaan) ? 'selected' : '' }}>
                                                                Material</option>
                                                            <option value="2"
                                                                {{ in_array('2', $jenis_pemeriksaan) ? 'selected' : '' }}>
                                                                Raw Material</option>
                                                            <option value="3"
                                                                {{ in_array('3', $jenis_pemeriksaan) ? 'selected' : '' }}>
                                                                Alat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jenis_pekerjaan">Keterangan
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="keterangan" name="keterangan">{{ isset($material_submission->keterangan) ? $material_submission->keterangan : 'N/A' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="status" value="1">
                                            </div>

                                            <div class="form-actions">
                                                <p>Isi file pendukung dibawah ini, Jika ingin mengganti file yang telah
                                                    diupload.
                                                </p>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="kak">Edit KAK <code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="kak" name="kak">
                                                            <label class="custom-file-label" for="kak"
                                                                aria-describedby="kak">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('kak'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('kak') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="pcm">Edit PCM <code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="pcm" name="pcm">
                                                            <label class="custom-file-label" for="pcm"
                                                                aria-describedby="pcm">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('pcm'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('pcm') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="brosur">Edit Brosur <code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="brosur" name="brosur">
                                                            <label class="custom-file-label" for="brosur"
                                                                aria-describedby="brosur">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('brosur'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('brosur') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="file_lain">Edit File Lain
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="file_lain" name="file_lain">
                                                            <label class="custom-file-label" for="file_lain"
                                                                aria-describedby="file_lain">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('file_lain'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('file_lain') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="brosur">Tambah Brosur
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="brosur" name="brosur_lain">
                                                            <label class="custom-file-label" for="brosur"
                                                                aria-describedby="brosur">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('brosur'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('brosur') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control"
                                                        for="jenis_pekerjaan">Keterangan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="catatan" name="catatan">{{ isset($material_submission->file_material_submission->keterangan) ? $material_submission->file_material_submission->keterangan : 'N/A' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.material_submission.index') }}"
                                                    style="width:120px;" class="btn bg-blue-grey text-white mr-1"
                                                    onclick="return confirm('Yakin ingin menutup halaman ini? , Setiap perubahan yang Anda buat tidak akan disimpan.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                    <i class="la la-check-square-o"></i> Submit
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <!-- END: Content-->

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        // Date Picker
        const fpDate = flatpickr('#tgl_permohonan', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        // summernote
        $('.summernote').summernote({
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });

        $('.summernote').summernote('fontSize', '12');
    </script>
@endpush
