@extends('layout.master')
@section('title', 'Siakad | Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Data Admin
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Data Admin</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.update', $admin->id) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" autocomplete="off" name="name" value="{{ $admin->name }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" autocomplete="off" name="email" value="{{ $admin->email }}">
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Simpan</button>
        </div>
    </div>
    </form>
</div>
@endsection
