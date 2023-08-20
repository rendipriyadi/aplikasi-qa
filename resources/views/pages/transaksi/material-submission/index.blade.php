@extends('layouts.app')

{{-- set title --}}
@section('title', 'Permohonan Material')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Permohonan QA</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Permohonan QA</li>
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

                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 2)
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Tambah Data</h4>
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

                                            <form class="form" action="{{ route('backsite.material_submission.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="no_pp">No PP <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="no_pp" name="no_pp"
                                                                class="form-control border-primary"
                                                                value="{{ old('no_pp') }}" autocomplete="off" required>

                                                            @if ($errors->has('no_pp'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('no_pp') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="no_permohonan">No
                                                            Permohonan
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="no_permohonan" name="no_permohonan"
                                                                class="form-control border-primary"
                                                                value="{{ old('no_permohonan') }}" autocomplete="off"
                                                                required>

                                                            @if ($errors->has('no_permohonan'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('no_permohonan') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="no_kontrak">No Kontrak
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="no_kontrak" name="no_kontrak"
                                                                class="form-control border-primary"
                                                                value="{{ old('no_kontrak') }}" autocomplete="off" required>

                                                            @if ($errors->has('no_kontrak'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('no_kontrak') }}</p>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-2 label-control" for="no_pp">Tgl Permohonan
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="tgl_permohonan" name="tgl_permohonan"
                                                                class="form-control" value="{{ old('tgl_permohonan') }}"
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
                                                            <select name="vendor_id" id="vendor_id"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($vendor as $key => $vendor_item)
                                                                    <option value="{{ $vendor_item->id }}">
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
                                                                <option value="{{ '' }}" disabled selected>
                                                                    Choose
                                                                </option>
                                                                @foreach ($divisi as $divisi => $divisi_item)
                                                                    <option value="{{ $divisi_item->id }}">
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
                                                            <textarea rows="5" class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan" required></textarea>
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
                                                                <option value="1">Material</option>
                                                                <option value="2">Raw Material</option>
                                                                <option value="3">Alat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control"
                                                            for="jenis_pekerjaan">Keterangan
                                                            <code style="color:red;">optional</code></label>
                                                        <div class="col-md-10">
                                                            <textarea rows="5" class="form-control summernote" id="keterangan" name="keterangan"></textarea>
                                                            <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                    + Enter jika ingin pindah baris</small></p>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="status" value="1">
                                                </div>

                                                <div class="form-actions">
                                                    <p>Isi file pendukung dibawah ini, Inputan <code>required</code>haru
                                                        diisi.
                                                    </p>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="kak">KAK <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="kak" name="kak" required>
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
                                                        <label class="col-md-2 label-control" for="pcm">PCM <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="pcm" name="pcm" required>
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
                                                        <label class="col-md-2 label-control" for="brosur">Brosur <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="brosur" name="brosur" required>
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
                                                        <label class="col-md-2 label-control" for="file_lain">File Lain
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
                                                        <label class="col-md-2 label-control"
                                                            for="jenis_pekerjaan">Keterangan<code
                                                                style="color:red;">optional</code></label>
                                                        <div class="col-md-10">
                                                            <textarea rows="5" class="form-control summernote" id="catatan" name="catatan"></textarea>
                                                            <p class="text-muted"><small class="text-danger">Gunakan Shift
                                                                    + Enter jika ingin pindah baris</small></p>
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
                                        <h4 class="card-title">Permohonan QA List</h4>
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
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No PP</th>
                                                            <th>No Kontrak</th>
                                                            <th>Jenis Pekerjaan</th>
                                                            <th>Tgl Permohonan</th>
                                                            <th>Status Permohonan</th>
                                                            <th>Hasil Pengujian</th>
                                                            <th style="text-align:center; width:100px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($material_submission as $key =>  $material_submission_item)
                                                            <tr data-entry-id="{{ $material_submission_item->id }}">
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $material_submission_item->no_pp ?? '' }}</td>
                                                                <td>{{ $material_submission_item->no_kontrak ?? '' }}</td>
                                                                <td>{{ $material_submission_item->jenis_pekerjaan ?? '' }}
                                                                </td>
                                                                <td>{{ isset($material_submission_item->tgl_permohonan) ? date('d F Y', strtotime($material_submission_item->tgl_permohonan)) : '' }}
                                                                </td>
                                                                <td>
                                                                    @if ($material_submission_item->status == 1)
                                                                        <span
                                                                            class="badge badge-yellow">{{ 'Permohonan Pemeriksaan' }}</span>
                                                                    @elseif($material_submission_item->status == 2)
                                                                        <span
                                                                            class="badge badge-danger">{{ 'Ditolak' }}</span>
                                                                    @elseif($material_submission_item->status == 3)
                                                                        <span
                                                                            class="badge badge-success">{{ 'Disetujui' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($material_submission_item->material_testing->status)
                                                                        ? $material_submission_item->material_testing->status == 1
                                                                        : '')
                                                                        <span
                                                                            class="badge badge-sucsess">{{ 'Sesuai' }}</span>
                                                                    @elseif(isset($material_submission_item->material_testing->status)
                                                                        ? $material_submission_item->material_testing->status == 2
                                                                        : '')
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
                                                                                data-remote="{{ route('backsite.material_submission.show', encrypt($material_submission_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Permohonan QA Detail"
                                                                                class="dropdown-item">
                                                                                Show Data
                                                                            </a>
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 2)
                                                                                @if ($material_submission_item->status == 1 ||
                                                                                    $material_submission_item->status == 2 ||
                                                                                    Auth::user()->detail_user->type_user_id == 1)
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('backsite.material_submission.edit', encrypt($material_submission_item->id)) }}">
                                                                                        Edit
                                                                                    </a>
                                                                                    <form
                                                                                        action="{{ route('backsite.material_submission.destroy', encrypt($material_submission_item->id)) }}"
                                                                                        method="POST"
                                                                                        onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                                        <input type="hidden"
                                                                                            name="_method" value="DELETE">
                                                                                        <input type="hidden"
                                                                                            name="_token"
                                                                                            value="{{ csrf_token() }}">
                                                                                        <input type="submit"
                                                                                            class="dropdown-item"
                                                                                            value="Delete">
                                                                                    </form>
                                                                                @endif
                                                                            @endif
                                                                            @if (Auth::user()->detail_user->type_user_id == 2)
                                                                                @if ($material_submission_item->material_testing != null &&
                                                                                    $material_submission_item->material_testing->status == 2)
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('backsite.material_submission.edit', encrypt($material_submission_item->id)) }}">
                                                                                        Edit
                                                                                    </a>
                                                                                    <form
                                                                                        action="{{ route('backsite.material_submission.destroy', encrypt($material_submission_item->id)) }}"
                                                                                        method="POST"
                                                                                        onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                                        <input type="hidden"
                                                                                            name="_method" value="DELETE">
                                                                                        <input type="hidden"
                                                                                            name="_token"
                                                                                            value="{{ csrf_token() }}">
                                                                                        <input type="submit"
                                                                                            class="dropdown-item"
                                                                                            value="Delete">
                                                                                    </form>
                                                                                @endif
                                                                            @endif
                                                                            @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.material_submission.edit_status', encrypt($material_submission_item->id)) }}">
                                                                                    Edit Status
                                                                                </a>
                                                                            @endif
                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.material_submission.show_status', encrypt($material_submission_item->id)) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Status Permohonan QA"
                                                                                class="dropdown-item">
                                                                                Show Status
                                                                            </a>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('backsite.material_submission.proses', encrypt($material_submission_item->id)) }}">
                                                                                Pemeriksaan Visual
                                                                            </a>
                                                                            @if (isset($material_submission_item->inspection_material->material_submission_id)
                                                                                ? $material_submission_item->inspection_material->material_submission_id == $material_submission_item->id
                                                                                : '')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.material_submission.penyerahan', encrypt($material_submission_item->id)) }}">
                                                                                    Pembuatan Sampel/Pendaftaran Lab
                                                                                </a>
                                                                            @endif
                                                                            @if (isset($material_submission_item->transfer_material->material_submission_id)
                                                                                ? $material_submission_item->transfer_material->material_submission_id == $material_submission_item->id
                                                                                : '')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.material_submission.pengujian', encrypt($material_submission_item->id)) }}">
                                                                                    Pengujian
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No PP</th>
                                                            <th>No Kontrak</th>
                                                            <th>Jenis Pekerjaan</th>
                                                            <th>Tgl Permohonan</th>
                                                            <th>Status Permohonan</th>
                                                            <th>Hasil Pengujian</th>
                                                            <th style="text-align:center; width:100px;">Action</th>
                                                        </tr>
                                                    </tfoot>
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
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });

        // Date Picker
        const fpDate = flatpickr('#tgl_permohonan', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
        });

        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10
        });

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
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
