@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pemeriksaan Visual')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Pemeriksaan Visual</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">Pemeriksaan Visual</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_submission.proses', encrypt($inspection_material->material_submission_id)) }}">kembali</a>
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
                                            <h4 class="card-title text-white">Pemeriksaan Material</h4>
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

                                            <form class="form" action="{{ route('backsite.check_material.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <input type="hidden" id="inspection_material_id"
                                                        name="inspection_material_id" class="form-control"
                                                        value="{{ $inspection_material->id }}">

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="jenis">Jenis Material
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
                                                        <label class="col-md-2 label-control" for="sumber">Sumber Material
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="sumber" name="sumber"
                                                                class="form-control" value="{{ old('sumber') }}"
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
                                                                class="form-control" value="{{ old('jumlah') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('jumlah'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('jumlah') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="satuan_id">Satuan<code
                                                                style="color:red;">required</code></label>
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

                                                            @if ($errors->has('satuan_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('satuan_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="metode">Metode
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="metode" name="metode"
                                                                class="form-control" value="Pemeriksaan Visual" readonly>

                                                            @if ($errors->has('metode'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('metode') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="hasil">Hasil
                                                            Pemeriksaan
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <select name="hasil" id="hasil_pemeriksaan"
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
                                        <h4 class="card-title">Pemeriksaan Material List</h4>
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
                                                            <th>Hasil Pemeriksaan</th>
                                                            <th style="text-align:center; width:100px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($check_material as $key => $check_material_item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $check_material_item->jenis ?? '' }}
                                                                </td>
                                                                <td>{{ $check_material_item->sumber ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $check_material_item->jumlah ?? '' }}
                                                                    {{ $check_material_item->satuan->name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge badge-yellow">{{ $check_material_item->metode }}</span>
                                                                </td>
                                                                <td>
                                                                    @if ($check_material_item->hasil == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Sesuai' }}</span>
                                                                    @elseif($check_material_item->hasil == 2)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.check_material.show', encrypt($check_material_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Check Material Detail"
                                                                                class="dropdown-item">
                                                                                Show
                                                                            </a>
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.check_material.edit', encrypt($check_material_item->id)) }}">
                                                                                    Edit
                                                                                </a>
                                                                                <form
                                                                                    action="{{ route('backsite.check_material.destroy', encrypt($check_material_item->id)) }}"
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
                                            <h4 class="card-title text-white">Pemeriksaan Alat</h4>
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

                                            <form class="form" action="{{ route('backsite.check_tool.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <input type="hidden" id="inspection_material_id"
                                                        name="inspection_material_id" class="form-control"
                                                        value="{{ $inspection_material->id }}">

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
                                        <h4 class="card-title">Pemeriksaan Alat List</h4>
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
                                                        @forelse($check_tool as $key => $check_tool_item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $check_tool_item->jenis ?? '' }}
                                                                </td>
                                                                <td>{{ $check_tool_item->type ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $check_tool_item->jumlah ?? '' }}
                                                                    {{ $check_tool_item->satuan->name ?? '' }}
                                                                </td>
                                                                <td>{{ $check_tool_item->tahun ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if ($check_tool_item->kondisi == 1)
                                                                        <span
                                                                            class="badge badge-yellow">{{ 'Baik' }}</span>
                                                                    @elseif($check_tool_item->kondisi == 2)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Sedang' }}</span>
                                                                    @elseif($check_tool_item->kondisi == 3)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Rusak' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($check_tool_item->hasil == 1)
                                                                        <span
                                                                            class="badge badge-yellow">{{ 'Sesuai' }}</span>
                                                                    @elseif($check_tool_item->hasil == 2)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Tidak' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.check_tool.show', encrypt($check_tool_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Check Tool Detail"
                                                                                class="dropdown-item">
                                                                                Show
                                                                            </a>
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.check_tool.edit', encrypt($check_tool_item->id)) }}">
                                                                                    Edit
                                                                                </a>
                                                                                <form
                                                                                    action="{{ route('backsite.check_tool.destroy', encrypt($check_tool_item->id)) }}"
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

@endsection

@push('after-style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('/assets/app-assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

        });
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
