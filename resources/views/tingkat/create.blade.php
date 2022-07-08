@extends('layout.master')
@section('title', 'Siakad | Tingkat')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-file-document-box"></i>
        </span> Tambah Data Tingkat
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tingkat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Tingkat</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tingkat.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Tingkat</label>
                            <input class="form-control" autocomplete="off" name="nama_tingkat"
                                value="{{ old('nama_tingkat') }}">
                            @error('nama_tingkat')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-gradient-primary float-right">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
