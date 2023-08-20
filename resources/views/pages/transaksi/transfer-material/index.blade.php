@extends('layouts.app')

{{-- set title --}}
@section('title', 'Pembuatan Sampel/Pendaftaran Lab')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Pembuatan Sampel/Pendaftaran Lab</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">Pembuatan Sampel/Pendaftaran Lab</li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.material_submission.index') }}">kembali</a>
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

                                            <form class="form" action="{{ route('backsite.transfer_material.store') }}"
                                                method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Isi input <code>required</code>, Sebelum menekan tombol submit.
                                                        </p>
                                                    </div>

                                                    <input type="hidden" name="material_submission_id"
                                                        value="{{ $material_submission->id }}">

                                                    <input type="hidden" name="inspection_material_id"
                                                        value="{{ $inspection_material['id'] }}">

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
                                                            <input type="text" id="jenis_pekerjaan"
                                                                name="jenis_pekerjaan" class="form-control border-primary"
                                                                value="{{ old('jenis_pekerjaan', isset($material_submission) ? $material_submission->jenis_pekerjaan : '') }}"
                                                                disabled>
                                                        </div>
                                                        <label class="col-md-2 label-control" for="tgl_pengujian">Tgl
                                                            Pembuatan/Pendaftaran
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="tgl_penyerahan" name="tgl_penyerahan"
                                                                class="form-control" value="{{ old('tgl_penyerahan') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('tgl_penyerahan'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('tgl_penyerahan') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-2 label-control" for="no_kontrak">Lokasi /
                                                            Workshop
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-4">
                                                            <input type="text" id="lokasi" name="lokasi"
                                                                class="form-control" value="{{ old('lokasi') }}"
                                                                autocomplete="off" required>

                                                            @if ($errors->has('lokasi'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('lokasi') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="created_by" id="created_by"
                                                        value="{{ Auth::user()->name }}">
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
                {{-- <div class="content-body"> --}}
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Pembuatan Sampel/Pendaftaran Lab List</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                                        <th>Tgl Pembuatan/Pendaftaran</th>
                                                        <th>Lokasi / Workshop</th>
                                                        <th>Hasil</th>
                                                        <th style="text-align:center; width:100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($transfer_material as $key => $transfer_material_item)
                                                        <tr data-entry-id="{{ $transfer_material_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $transfer_material_item->material_submission->no_pp ?? '' }}
                                                            </td>
                                                            <td>{{ $transfer_material_item->material_submission->no_kontrak ?? '' }}
                                                            </td>
                                                            <td>{{ $transfer_material_item->material_submission->jenis_pekerjaan ?? '' }}
                                                            </td>
                                                            <td>{{ isset($transfer_material_item->tgl_penyerahan) ? date('d F Y', strtotime($transfer_material_item->tgl_penyerahan)) : '' }}
                                                            </td>
                                                            <td>{{ $transfer_material_item->lokasi ?? '' }}
                                                            </td>
                                                            <td>
                                                                @if ($transfer_material_item->status == 1)
                                                                    <span
                                                                        class="badge badge-success">{{ 'Sesuai' }}</span>
                                                                @elseif($transfer_material_item->status == 2)
                                                                    <span
                                                                        class="badge badge-danger">{{ 'Tidak Sesuai' }}</span>
                                                                @else
                                                                    <span>{{ 'N/A' }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group mr-1 mb-1">
                                                                    @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                        <a href="{{ route('backsite.transfer_material.print', encrypt($transfer_material_item->id)) }}"
                                                                            class="btn btn-danger btn-sm mr-1"
                                                                            title="Print data" target="_blank"><i
                                                                                class="bx bx-printer"></i></a>
                                                                    @endif
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.transfer_material.show', encrypt($transfer_material_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Pembuatan Sampel/Pendaftaran Lab"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        @if (Auth::user()->detail_user->type_user_id == 1 || Auth::user()->detail_user->type_user_id == 3)
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('backsite.transfer_material.edit', encrypt($transfer_material_item->id)) }}">
                                                                                Edit
                                                                            </a>
                                                                            <form
                                                                                action="{{ route('backsite.transfer_material.destroy', encrypt($transfer_material_item->id)) }}"
                                                                                method="POST"
                                                                                onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                                <input type="hidden" name="_method"
                                                                                    value="DELETE">
                                                                                <input type="hidden" name="_token"
                                                                                    value="{{ csrf_token() }}">
                                                                                <input type="submit"
                                                                                    class="dropdown-item" value="Delete">
                                                                            </form>
                                                                        @endif
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.transfer_material.proses', encrypt($transfer_material_item->id)) }}">
                                                                            Proses
                                                                        </a>
                                                                        @if (Auth::user()->detail_user->type_user_id == 1 ||
                                                                            Auth::user()->detail_user->type_user_id == 4 ||
                                                                            Auth::user()->detail_user->type_user_id == 5)
                                                                            <form
                                                                                action="{{ route('backsite.transfer_material.aprove', encrypt($transfer_material_item->id)) }}"
                                                                                method="POST"
                                                                                onsubmit="return confirm('Anda yakin ingin mengaprove data ini ?');">
                                                                                <input type="hidden" name="aprove"
                                                                                    value="1">
                                                                                <input type="hidden" name="_token"
                                                                                    value="{{ csrf_token() }}">
                                                                                <input type="submit"
                                                                                    class="dropdown-item" value="Approve">
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
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No PP</th>
                                                        <th>No Kontrak</th>
                                                        <th>Jenis Pekerjaan</th>
                                                        <th>Tgl Pembuatan/Pendaftaran</th>
                                                        <th>Lokasi / Workshop</th>
                                                        <th>Hasil</th>
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
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

        });

        // Date Picker
        const fpDate = flatpickr('#tgl_penyerahan', {
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
