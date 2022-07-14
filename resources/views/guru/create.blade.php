@extends('layout.master')
@section('title', 'Siakad | Guru')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tambah Data Guru
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Guru</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('guru.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>NIP</label>
                    <input class="form-control @error('nip') is-invalid @enderror" autocomplete="off" name="nip" value="{{ old('nip') }}">
                    @error('nip')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control @error('nama_guru') is-invalid @enderror" autocomplete="off" name="nama_guru" value="{{ old('nama_guru') }}">
                    @error('nama_guru')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                        <option selected disabled value>Pilih Jenis Kelamin</option>
                        <option value="Laki Laki" {{ old('jenis_kelamin') == "Laki Laki" ? 'selected' : ''}}>Laki Laki
                        </option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == "Perempuan" ? 'selected' : ''}}>Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input class="form-control @error('tempat_lahir') is-invalid @enderror" autocomplete="off" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" autocomplete="off" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" autocomplete="off" name="alamat"
                        value="{{ old('alamat') }}">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input class="form-control @error('telepon') is-invalid @enderror" autocomplete="off" name="telepon" value="{{ old('telepon') }}">
                    @error('telepon')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <input class="form-control @error('agama') is-invalid @enderror" autocomplete="off" name="agama" value="{{ old('agama') }}">
                            @error('agama')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input class="form-control @error('pendidikan') is-invalid @enderror" autocomplete="off" name="pendidikan"
                                value="{{ old('pendidikan') }}">
                            @error('pendidikan')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" autocomplete="off" name="email" type="email" value="{{ old('email') }}">
                    @error('email')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <img class="preview-image mb-3 col-sm-3">
                    <input class="form-control" autocomplete="off" name="foto" type="file" value="{{ old('foto') }}" onchange="previewImage()">
                    @error('foto')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group"></div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function previewImage() {
        const reader = new FileReader();
        reader.onload = function () {
            $('.preview-image').attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection