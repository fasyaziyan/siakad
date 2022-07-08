@extends('layout.master')
@section('title', 'Siakad | Kelas')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Data Kelas
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Kelas</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>ID Kelas</label>
                    <input class="form-control" disabled autocomplete="off" name="id_kelas"
                        value="{{ $kelas->id_kelas }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input class="form-control" autocomplete="off" name="nama_kelas"
                                value="{{ $kelas->nama_kelas}}">
                            @error('nama_kelas')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tingkatan</label>
                            <select class="form-control" name="id_tingkat">
                                <option disabled selected>Pilih Tingkatan</option>
                                @foreach ($tingkat as $tingkat)
                                <option value="{{ $tingkat->id_tingkat }}"
                                    {{ $kelas->id_tingkat == $tingkat->id_tingkat ? 'selected' : ''}}>
                                    {{ $tingkat->nama_tingkat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select class="form-control js-example-basic-single" name="nip">
                                <option disabled selected>Pilih wali</option>
                                @foreach ($guru as $data)
                                <option value="{{ $data->nip }}" {{ $data->nip == $kelas->nip ? 'selected' : '' }}>
                                    {{ $data->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select class="form-control js-example-basic-single" name="id_kuri">
                                <option disabled selected>Pilih Tahun Ajaran</option>
                                @foreach ($kurikulum as $data)
                                <option value="{{ $data->id_kuri }}" {{ $data->id_kuri == $kelas->id_kuri ? 'selected' : '' }}>Semester {{ $data->semester }} {{ $data->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Simpan</button>
        </div>
    </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection