@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - Check Material')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Check Material</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Check Material</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.inspection_material.proses', encrypt($check_material->inspection_material_id)) }}">kembali</a>
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
                                            action="{{ route('backsite.check_material.update', [$check_material->id]) }}"
                                            method="POST" enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jenis">Jenis Material
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="jenis" name="jenis"
                                                            class="form-control"
                                                            value="{{ old('jenis', isset($check_material) ? $check_material->jenis : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('jenis'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jenis') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="sumber">Sumber Material
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="sumber" name="sumber"
                                                            class="form-control"
                                                            value="{{ old('sumber', isset($check_material) ? $check_material->sumber : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('sumber'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('sumber') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="jumlah">Jumlah Sampel
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="jumlah" name="jumlah"
                                                            class="form-control"
                                                            value="{{ old('jumlah', isset($check_material) ? $check_material->jumlah : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('jumlah'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jumlah') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="satuan_id">Satuan<code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="satuan_id" id="satuan" class="form-control select2"
                                                            required>
                                                            <option value="{{ '' }}" disabled selected>
                                                                Choose
                                                            </option>
                                                            @foreach ($satuan as $key => $satuan_item)
                                                                <option value="{{ $satuan_item->id }}"
                                                                    {{ $satuan_item->id == $check_material->satuan_id ? 'selected' : '' }}>
                                                                    {{ $satuan_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('satuan_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('satuan_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="metode">Metode
                                                        Pemeriksaan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <input type="text" id="metode" name="metode"
                                                            class="form-control"
                                                            value="{{ isset($check_material) ? $check_material->metode : '' }}"
                                                            readonly>

                                                        @if ($errors->has('metode'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('metode') }}</p>
                                                        @endif
                                                    </div>
                                                    <label class="col-md-2 label-control" for="hasil">Hasil
                                                        Pemeriksaan
                                                        <code style="color:red;">required</code></label>
                                                    <div class="col-md-4">
                                                        <select name="hasil" id="hasil"
                                                            class="form-control select2" required>
                                                            <option value="1"
                                                                {{ $check_material->hasil == 1 ? 'selected' : '' }}>Sesuai
                                                            </option>
                                                            <option value="2"
                                                                {{ $check_material->hasil == 2 ? 'selected' : '' }}>Tidak
                                                                Sesuai</option>
                                                        </select>

                                                        @if ($errors->has('hasil'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('hasil') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.inspection_material.proses', encrypt($check_material->inspection_material_id)) }}"
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
