@extends('layout.master')
@section('title', 'Siakad | Profile Guru')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account menu-icon"></i>
        </span> Profile Guru
    </h3>
</div>
<div class="row">

    <div class="col-sm-12 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <br>
            <img src="{{ asset ('images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
            <center>
                <img @if($guru->foto == null) src="{{ asset('images/faces/face1.jpg') }}" @else src="{{ asset('img/guru/' . $guru->foto) }}" @endif
                    style="border-radius: 50%; border: 3px solid #ffffff;width:150px; height:150px" alt="image"><br>
                <h4 class="mb-5">{{ $guru->nama_guru }}</h4>
            </center>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body">
                    <small class="text-muted">NiP</small>
                    <h6>{{ $guru->nip }}</h6>
                    <small class="text-muted">Nama Lengkap</small>
                    <h6>{{ $guru->nama_guru }}</h6>
                    <small class="text-muted">Jenis Kelamin</small>
                    <h6>{{ $guru->jenis_kelamin }}</h6>
                    <small class="text-muted">Tempat Lahir</small>
                    <h6>{{ $guru->tempat_lahir }}</h6>
                    <small class="text-muted">Tanggal Lahir</small>
                    <h6>{{ $guru->tanggal_lahir }}</h6>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <small class="text-muted">Alamat</small>
                <h6>{{ $guru->alamat }}</h6>
                    <small class="text-muted">Telepon</small>
                    <h6>{{ $guru->telepon }}</h6>
                    <small clas s="text-muted">Agama</small>
                    <h6>{{ $guru->agama }}</h6>
                    <small class="text-muted">Pendidikan</small>
                    <h6>{{ $guru->pendidikan }}</h6>
                    <small class="text-muted">Email</small>
                    <h6>{{ $guru->email }}</h6>
            </div>
        </div>
    </div>
</div>
@endsection
