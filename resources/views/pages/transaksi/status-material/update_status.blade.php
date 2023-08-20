@extends('layouts.app')

{{-- set title --}}
@section('title', 'Status - Permohonan Material')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Status Permohonan Material</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Permohonan QA</a></li>
                                <li class="breadcrumb-item active">Status</li>
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

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.material_submission.change', [$material_submission->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-body">
                                                <input type="hidden" name="id" id="id"
                                                    value="{{ $material_submission->id }}">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Status <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="status" id="status" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>Choose
                                                            </option>
                                                            <option value="1"
                                                                {{ $material_submission->status == 1 ? 'selected' : '' }}>
                                                                Permohonan Pemeriksaan</option>
                                                            <option value="2"
                                                                {{ $material_submission->status == 2 ? 'selected' : '' }}>
                                                                Ditolak</option>
                                                            <option value="3"
                                                                {{ $material_submission->status == 3 ? 'selected' : '' }}>
                                                                Disetujui</option>
                                                        </select>

                                                        @if ($errors->has('status'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('status') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Keterangan <code
                                                            style="color:red;">optional</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <textarea rows="5" class="form-control" id="keterangan" name="keterangan">{{ isset($material_submission->status_material_submission->keterangan) ? $material_submission->status_material_submission->keterangan : 'N/A' }}</textarea>

                                                        @if ($errors->has('keterangan'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('keterangan') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row rapat" style="display: none;">
                                                    <label class="col-md-3 label-control" for="file">Upload (Undangan
                                                        Rapat) <code style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="file"
                                                                name="file">
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

@push('after-script')
    <script>
        $(document).ready(function() {
            $('#status').change(function(e) {
                e.preventDefault();

                if ($(this).val() == "3") {
                    $('.rapat').show();
                } else {
                    $('.rapat').hide();
                }
            });

            if ($('#status').val() == 3) {
                $('.rapat').show();
            }
        });
    </script>
@endpush
