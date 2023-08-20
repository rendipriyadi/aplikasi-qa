@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Test Tool')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Test Tool</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                <li class="breadcrumb-item"><a href="#">Test Tool</a></li>
                                <li class="breadcrumb-item">Edit</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_testing.proses', encrypt($test_tool->material_testing_id)) }}">kembali</a>
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
                                            action="{{ route('backsite.test_tool.update', [$test_tool->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jenis">Jenis
                                                        Alat
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="jenis" name="jenis"
                                                            class="form-control"
                                                            value="{{ old('jenis', isset($test_tool) ? $test_tool->jenis : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('jenis'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jenis') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="type">Jenis / Type
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="type" name="type"
                                                            class="form-control"
                                                            value="{{ old('type', isset($test_tool) ? $test_tool->type : '') }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('type'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="kapasitas">Kapasitas
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="kapasitas" name="kapasitas"
                                                            class="form-control"
                                                            value="{{ old('kapasitas', isset($test_tool) ? $test_tool->kapasitas : '') }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('kapasitas'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('kapasitas') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="tahun">Tahun
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="tahun"
                                                            id="tahun" data-provide="datepicker" data-date-format="yyyy"
                                                            data-date-min-view-mode="2"
                                                            value="{{ isset($test_tool) ? $test_tool->tahun : '' }}"
                                                            autocomplete="off">

                                                        @if ($errors->has('tahun'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('tahun') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jumlah">Jumlah
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="jumlah" name="jumlah"
                                                            class="form-control"
                                                            value="{{ old('jumlah', isset($test_tool) ? $test_tool->jumlah : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('jumlah'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jumlah') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="satuan">Satuan
                                                        <code style="color:red;">optional</code></label>
                                                    <div class="col-md-4">
                                                        <select name="satuan_id" id="satuan"
                                                            class="form-control select2">
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($satuan as $key => $satuan_item)
                                                                <option value="{{ $satuan_item->id }}"
                                                                    {{ $satuan_item->id == $test_tool->satuan_id ? 'selected' : '' }}>
                                                                    {{ $satuan_item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="kondisi">Kondisi Alat
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="kondisi" id="kondisi"
                                                            class="form-control select2">
                                                            <option value="1"
                                                                {{ $test_tool->konidisi == 1 ? 'selected' : '' }}>Baik
                                                            </option>
                                                            <option value="2"
                                                                {{ $test_tool->konidisi == 2 ? 'selected' : '' }}>Sedang
                                                            </option>
                                                            <option value="3"
                                                                {{ $test_tool->konidisi == 3 ? 'selected' : '' }}>Rusak
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('kondisi'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('kondisi') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="hasil">Hasil
                                                        Pemeriksaan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="hasil" id="hasil"
                                                            class="form-control select2">
                                                            <option value="1"
                                                                {{ $test_tool->hasil == 1 ? 'selected' : '' }}>Sesuai
                                                            </option>
                                                            <option value="2"
                                                                {{ $test_tool->hasil == 2 ? 'selected' : '' }}>Tidak
                                                                Sesuai</option>
                                                        </select>

                                                        @if ($errors->has('hasil'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('hasil') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.material_testing.proses', encrypt($test_tool->material_testing_id)) }}"
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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
