@extends('layout.master')
@section('title', 'Siakad | Kelas')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tambah Data Kelas
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
            <form action="{{ route('kelas.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input class="form-control" autocomplete="off" name="nama_kelas"
                                value="{{ old('nama_kelas') }}">
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
                                <option value="{{ $tingkat->id_tingkat }}" {{ old('id_tingkat') == $tingkat->id_tingkat ? 'selected' : ''}}>{{ $tingkat->nama_tingkat }}</option>
                                @endforeach
                            </select>
                            @error('id_tingkat')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select class="form-control js-example-basic-single" name="nip">
                                <option disabled selected>Pilih Wali Kelas</option>
                                @foreach ($guru as $data)
                                <option value="{{ $data->nip }}" {{ old('nip') == $data->nip ? 'selected' : ''}}>{{ $data->nama_guru }}</option>
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
                                <option value="{{ $data->id_kuri }}" {{ old('id_kuri') == $data->id_kuri ? 'selected' : ''}}>Semester {{ $data->semester }} {{ $data->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary float-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection