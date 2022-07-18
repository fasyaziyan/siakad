@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-file-document-box"></i>
        </span> Edit Data Siswa
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('siswa.update',$siswa->nisn) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>NISN</label>
                    <input type="text" class="form-control" disabled autocomplete="off" name="nisn" value="{{ $siswa->nisn }}">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" autocomplete="off" name="nama" value="{{ $siswa->nama}}">
                    @error('nama')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option disabled value>Pilih Jenis Kelamin</option>
                        <option value="Laki Laki" {{ $siswa->jenis_kelamin == "Laki Laki" ? 'selected' : ''}}>Laki Laki
                        </option>
                        <option value="Perempuan" {{ $siswa->jenis_kelamin == "Perempuan" ? 'selected' : ''}}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input class="form-control" autocomplete="off" name="tempat_lahir"
                                value="{{ $siswa->tempat_lahir}}">
                            @error('tempat_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir"
                                value="{{ $siswa->tanggal_lahir}}">
                            @error('tanggal_lahir')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" autocomplete="off" name="alamat"
                        value="{{ $siswa->alamat }}">{{ $siswa->alamat }}</textarea>
                    @error('alamat')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input class="form-control" autocomplete="off" name="telepon" value="{{ $siswa->telepon}}">
                    @error('telepon')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input class="form-control" autocomplete="off" name="agama" value="{{ $siswa->agama}}">
                    @error('agama')
                    <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label">Nama Ayah</label>
                                <input class="form-control" autocomplete="off" name="nama_ayah"
                                    value="{{ $siswa->nama_ayah}}">
                                @error('nama_ayah')
                                <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input class="form-control" autocomplete="off" name="nama_ibu"
                                value="{{ $siswa->nama_ibu}}">
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
                                <option value="{{ $data->id_kelas }}"
                                    {{ $data->id_kelas == $siswa->id_kelas ? 'selected' : '' }}>
                                    {{ $data->tingkat->nama_tingkat }}
                                    {{ $data->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" autocomplete="off" name="email"
                                value="{{ $siswa->email}}">
                            @error('email')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="hidden" name="oldfoto" value="{{ $siswa->foto }}">
                        @if ($siswa->foto)
                        <img src="{{ asset('img/siswa/' . $siswa->foto) }}" alt="{{ $siswa->nama }}"
                            class="preview-image mb-3 col-sm-3">
                        @else
                        <img class="preview-image mb-3 col-sm-3">
                        @endif
                        <input class="form-control" autocomplete="off" name="foto" type="file" value="{{ old('foto') }}" onchange="previewImage()">
                        @error('foto')
                        <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Simpan</button>
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
            const preview = document.querySelector('.preview-image');
            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection