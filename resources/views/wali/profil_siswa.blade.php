@extends('layout.master')
@section('title', 'Siakad | Profile Siswa')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account menu-icon"></i>
        </span> Profile Siswa
    </h3>
</div>
<div class="row">
    <div class="col-sm-12 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <br>
            <img src="{{ asset ('images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
            <center>
                <img @if($siswa->foto == null) src="{{ asset('images/faces/face1.jpg') }}" @else src="{{ asset('img/siswa/' . $siswa->foto) }}" @endif
                    style="border-radius: 50%; border: 3px solid #ffffff;width:150px; height:150px" alt="image"><br>
                <h4 class="mb-5">{{ $siswa->nama }}</h4>
            </center>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <small class="text-muted">NISN</small>
                <h6>{{ $siswa->nisn }}</h6>
                <small class="text-muted">Nama Lengkap</small>
                <h6>{{ $siswa->nama }}</h6>
                <small class="text-muted">Jenis Kelamin</small>
                <h6>{{ $siswa->jenis_kelamin }}</h6>
                <small class="text-muted">Tempat & Tanggal Lahir</small>
                <h6>{{ $siswa->tempat_lahir }}{{ $siswa->tanggal_lahir }}</h6>
                <small class="text-muted">Alamat</small>
                <h6>{{ $siswa->alamat }}</h6>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <small class="text-muted">Nama Ayah</small>
                <h6>{{ $siswa->nama_ayah }}</h6>
                <small class="text-muted">Nama Ibu</small>
                <h6>{{ $siswa->nama_ibu }}</h6>
                <small clas s="text-muted">Telepon</small>
                <h6>{{ $siswa->telepon }}</h6>
                <small class="text-muted">Agama</small>
                <h6>{{ $siswa->agama }}</h6>
                <small class="text-muted">Email</small>
                <h6>{{ $siswa->email }}</h6>
            </div>
        </div>
    </div>
</div>
@endsection
