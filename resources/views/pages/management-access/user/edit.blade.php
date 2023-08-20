@extends('layouts.app')

{{-- set title --}}
@section('title', 'Edit - User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">User</li>
                                <li class="breadcrumb-item active">Edit</li>
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
                                            action="{{ route('backsite.user.update', [$user->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Nama <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('name', isset($user) ? $user->name : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="jabatan">Jabatan <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="jabatan" name="jabatan"
                                                            class="form-control"
                                                            value="{{ old('jabatan', isset($user) ? $user->jabatan : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('jabatan'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('jabatan') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Username <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" id="username" name="username"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('username', isset($user) ? $user->username : '') }}"
                                                            autocomplete="off" required>

                                                        @if ($errors->has('username'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('username') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Ganti
                                                        Password</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" placeholder="example John Doe or Jane"
                                                            value="{{ old('password') }}">

                                                        @if ($errors->has('password'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('password') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div
                                                    class="form-group row {{ $errors->has('type_user_id') ? 'has-error' : '' }}">
                                                    <label class="col-md-3 label-control">Type User <code
                                                            style="color:red;">required</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="type_user_id" id="type_user_id"
                                                            class="form-control select2" required>
                                                            <option value="{{ '' }}" disabled selected>Choose
                                                            </option>
                                                            @foreach ($type_user as $key => $type_user_item)
                                                                <option value="{{ $type_user_item->id }}"
                                                                    {{ $type_user_item->id == $user->detail_user->type_user_id ? 'selected' : '' }}>
                                                                    {{ $type_user_item->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('type_user_id'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('type_user_id') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions text-right">
                                                <a href="{{ route('backsite.user.index') }}" style="width:120px;"
                                                    class="btn bg-blue-grey text-white mr-1"
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
