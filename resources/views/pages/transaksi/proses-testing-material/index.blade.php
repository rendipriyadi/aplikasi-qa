@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pengujian')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Pengujian</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">Pengujian</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_submission.pengujian', encrypt($material_testing->material_submission_id)) }}">kembali</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Pengujian Material</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card-content collapse hide">
                                        <div class="card-body card-dashboard">

                                            <form class="form" action="{{ route('backsite.test_material.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <input type="hidden" id="material_testing_id"
                                                        name="material_testing_id" class="form-control"
                                                        value="{{ $material_testing->id }}">

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="check_material_id">Jenis
                                                            Material
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <select name="check_material_id" id="check_material_id"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($check_material as $key => $check_material_item)
                                                                    <option value="{{ $check_material_item->id }}">
                                                                        {{ $check_material_item->jenis }}</option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('check_material_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('check_material_id') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="sumber">Sumber Material
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="sumber" name="sumber"
                                                                class="form-control" value="{{ old('sumber') }}"
                                                                autocomplete="off" disabled required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="jumlah">Jumlah Sampel
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="jumlah" name="jumlah"
                                                                class="form-control" value="{{ old('jumlah') }}"
                                                                autocomplete="off" required>
                                                        </div>
                                                        <label class="col-md-2 label-control" for="satuan">Satuan
                                                            <code style="color:red;">optional</code></label>
                                                        <div class="col-md-4">
                                                            <select name="satuan_id" id="satuan"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($satuan as $key => $satuan_item)
                                                                    <option value="{{ $satuan_item->id }}">
                                                                        {{ $satuan_item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="metode">Metode
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="metode" name="metode"
                                                                class="form-control" value="Pengujian" readonly>

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
                                                                class="form-control select2">
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                <option value="1">Sesuai</option>
                                                                <option value="2">Tidak Sesuai</option>
                                                            </select>

                                                            @if ($errors->has('hasil'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('hasil') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </section>

                {{-- table card --}}
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Pengujian Material List</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table class="table table-sm table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Jenis Material</th>
                                                            <th>Sumber Material</th>
                                                            <th>Jumlah Sampel</th>
                                                            <th>Metode Pemeriksaan</th>
                                                            <th>Hasil</th>
                                                            <th style="text-align:center; width:100px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($test_material as $key => $test_material_item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $test_material_item->check_material->jenis ?? '' }}
                                                                </td>
                                                                <td>{{ $test_material_item->check_material->sumber ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $test_material_item->jumlah ?? '' }}
                                                                    {{ $test_material_item->satuan->name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge badge-yellow">{{ $test_material_item->metode }}</span>
                                                                </td>
                                                                <td>
                                                                    @if ($test_material_item->hasil == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Sesuai' }}</span>
                                                                    @elseif($test_material_item->hasil == 2)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                            <button type="button"
                                                                                class="btn btn-cyan btn-sm mr-1"
                                                                                title="Tambah File"
                                                                                onclick="upload('{{ $test_material_item->id }}')"><i
                                                                                    class="bx bx-file"></i></button>
                                                                        @endif
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.test_material.show', encrypt($test_material_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Test Material Detail"
                                                                                class="dropdown-item">
                                                                                Show
                                                                            </a>
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.test_material.edit', encrypt($test_material_item->id)) }}">
                                                                                    Edit
                                                                                </a>
                                                                                <form
                                                                                    action="{{ route('backsite.test_material.destroy', encrypt($test_material_item->id)) }}"
                                                                                    method="POST"
                                                                                    onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                                    <input type="hidden" name="_method"
                                                                                        value="DELETE">
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit"
                                                                                        class="dropdown-item"
                                                                                        value="Delete">
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>

            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Pengujian Alat</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card-content collapse hide">
                                        <div class="card-body card-dashboard">

                                            <form class="form" action="{{ route('backsite.test_tool.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <input type="hidden" id="material_testing_id"
                                                        name="material_testing_id" class="form-control"
                                                        value="{{ $material_testing->id }}">

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="jenis">Jenis
                                                            Alat
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="jenis" name="jenis"
                                                                class="form-control" value="{{ old('jenis') }}"
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
                                                                class="form-control" value="{{ old('type') }}"
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
                                                                class="form-control" value="{{ old('kapasitas') }}"
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
                                                                id="tahun" data-provide="datepicker"
                                                                data-date-format="yyyy" data-date-min-view-mode="2"
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
                                                                class="form-control" value="{{ old('jumlah') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('jumlah'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('jumlah') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="satuan">Satuan
                                                            <code style="color:red;">optional</code></label>
                                                        <div class="col-md-4">
                                                            <select name="satuan_id" id="satuan_id"
                                                                class="form-control select2">
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($satuan as $key => $satuan_item)
                                                                    <option value="{{ $satuan_item->id }}">
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
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                <option value="1">Baik</option>
                                                                <option value="2">Sedang</option>
                                                                <option value="3">Rusak</option>
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
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                <option value="1">Sesuai</option>
                                                                <option value="2">Tidak Sesuai</option>
                                                            </select>

                                                            @if ($errors->has('hasil'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('hasil') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                        onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </section>

                {{-- table card --}}
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Pengujian Alat List</h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table class="table table-sm table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Jenis</th>
                                                            <th>Jenis / Type</th>
                                                            <th>Jumlah</th>
                                                            <th>Tahun</th>
                                                            <th>Kondisi Alat</th>
                                                            <th>Hasil Pemeriksaan</th>
                                                            <th style="text-align:center; width:100px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($test_tool as $key => $test_tool_item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $test_tool_item->jenis ?? '' }}
                                                                </td>
                                                                <td>{{ $test_tool_item->type ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $test_tool_item->jumlah ?? '' }}
                                                                    {{ $test_tool_item->satuan->name ?? '' }}
                                                                </td>
                                                                <td>{{ $test_tool_item->tahun ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if ($test_tool_item->kondisi == 1)
                                                                        <span
                                                                            class="badge badge-yellow">{{ 'Baik' }}</span>
                                                                    @elseif($test_tool_item->kondisi == 2)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Sedang' }}</span>
                                                                    @elseif($test_tool_item->kondisi == 3)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Rusak' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($test_tool_item->hasil == 1)
                                                                        <span
                                                                            class="badge badge-yellow">{{ 'Sesuai' }}</span>
                                                                    @elseif($test_tool_item->hasil == 2)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Tidak' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                            <button type="button"
                                                                                class="btn btn-cyan btn-sm mr-1"
                                                                                title="Tambah File"
                                                                                onclick="uploadTool('{{ $test_tool_item->id }}')"><i
                                                                                    class="bx bx-file"></i></button>
                                                                        @endif
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.test_tool.show', encrypt($test_tool_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Test Tool Detail"
                                                                                class="dropdown-item">
                                                                                Show
                                                                            </a>
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.test_tool.edit', encrypt($test_tool_item->id)) }}">
                                                                                    Edit
                                                                                </a>
                                                                                <form
                                                                                    action="{{ route('backsite.test_tool.destroy', encrypt($test_tool_item->id)) }}"
                                                                                    method="POST"
                                                                                    onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                                    <input type="hidden" name="_method"
                                                                                        value="DELETE">
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit"
                                                                                        class="dropdown-item"
                                                                                        value="Delete">
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="viewmodal" style="display: none;"></div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#check_material_id').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: "{{ route('backsite.ajax_controller.proses') }}",
                    data: {
                        id_test: $(this).val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            let data = response.sukses;

                            $('#sumber').val(data.sumber);
                        }

                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.error
                            }).then(result => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });

        function upload(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.ajax_controller.form_upload') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalupload').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        function uploadTool(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('backsite.ajax_controller.form_upload_tool') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalupload').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    </script>

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
