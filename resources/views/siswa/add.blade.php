@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-file-document-box"></i>
        </span> Tambah Data Siswa
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Siswa</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>NISN</label>
                    <input autocomplete="off" class="form-control" name="nisn" value="{{ old('nisn') }}">
                    @error('nisn')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input autocomplete="off" class="form-control" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option selected disabled value>Pilih Jenis Kelamin</option>
                        <option value="Laki Laki" {{ old('jenis_kelamin') == "Laki Laki" ? 'selected' : ''}}>Laki - Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == "Perempuan" ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input autocomplete="off" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input autocomplete="off" type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea autocomplete="off" class="form-control" name="alamat" value="{{ old('alamat') }}">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input autocomplete="off" class="form-control" name="telepon" value="{{ old('telepon') }}">
                    @error('telepon')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input autocomplete="off" class="form-control" name="agama" value="{{ old('agama') }}">
                    @error('agama')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input autocomplete="off" class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}">
                            @error('nama_ayah')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input autocomplete="off" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}">
                            @error('nama_ibu')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control" name="id_kelas">
                                <option selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $data)
                                <option value="{{ $data->id_kelas }}" {{ old('id_kelas') == $data->id_kelas ? 'selected' : ''}}>{{ $data->tingkat->nama_tingkat }} -
                                    {{ $data->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @error('email')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <img class="preview-image mb-3 col-sm-3">
                        <input class="form-control" autocomplete="off" name="foto" type="file" value="{{ old('foto') }}" onchange="previewImage()">
                        @error('foto')
                        <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
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
