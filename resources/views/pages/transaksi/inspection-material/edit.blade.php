@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Pemeriksaan Visual')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Pemeriksaan Visual</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pemeriksaan Visual</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_submission.proses', encrypt($inspection_material->material_submission_id)) }}">kembali</a>
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

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.inspection_material.update', [$inspection_material->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_pp">No PP <code
                                                            style="color:red;">disabled</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_pp" name="no_pp"
                                                            class="form-control border-primary"
                                                            value="{{ old('no_pp', isset($material_submission) ? $material_submission->no_pp : '') }}"
                                                            disabled>
                                                    </div>
                                                    <label class="col-md-2 label-control" for="no_permohonan">No
                                                        Permohonan
                                                        <code style="color:red;">disabled</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="no_permohonan" name="no_permohonan"
                                                            class="form-control border-primary"
                                                            value="{{ old('no_permohonan', isset($material_submission) ? $material_submission->no_permohonan : '') }}"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_permohonan">Jenis
                                                        Pekerjaan
                                                        <code style="color:red;">disabled</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan"
                                                            class="form-control border-primary"
                                                            value="{{ old('jenis_pekerjaan', isset($material_submission) ? $material_submission->jenis_pekerjaan : '') }}"
                                                            disabled>
                                                    </div>
                                                    <label class="col-md-2 label-control" for="no_pp">Tgl Pemeriksaan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="tgl_pemeriksaan" name="tgl_pemeriksaan"
                                                            class="form-control"
                                                            value="{{ old('tgl_pemeriksaan', isset($inspection_material) ? $inspection_material->tgl_pemeriksaan : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('tgl_pemeriksaan'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('tgl_pemeriksaan') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_kontrak">Lokasi /
                                                        Workshop
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="lokasi" name="lokasi"
                                                            class="form-control"
                                                            value="{{ old('lokasi', isset($inspection_material) ? $inspection_material->lokasi : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('lokasi'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('lokasi') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="kak">File Pleno<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="file" name="file">
                                                            <label class="custom-file-label" for="file"
                                                                aria-describedby="file">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small></p>

                                                        @if ($errors->has('file'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('file') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="no_kontrak">Status
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="status" id="status"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $inspection_material->status == 1 ? 'selected' : '' }}>
                                                                Sesuai</option>
                                                            <option value="2"
                                                                {{ $inspection_material->status == 2 ? 'selected' : '' }}>
                                                                Tidak Sesuai</option>
                                                        </select>

                                                        @if ($errors->has('lokasi'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('lokasi') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="kak">File Hasil Visual
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="file_inspection" name="file_inspection[]"
                                                                multiple="multiple">
                                                            <label class="custom-file-label" for="file"
                                                                aria-describedby="file">Pilih File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Dapat mengunggah
                                                                lebih dari 1 file</small></p>

                                                        @if ($errors->has('file'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('file') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="keterangan">Catatan<code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" class="form-control summernote" id="keterangan" name="keterangan">{{ isset($inspection_material) ? $inspection_material->keterangan : '' }}</textarea>
                                                        <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                + Enter jika ingin pindah baris</small></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.material_submission.proses', encrypt($inspection_material->material_submission_id)) }}"
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
        const fpDate = flatpickr('#tgl_pemeriksaan', {
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
