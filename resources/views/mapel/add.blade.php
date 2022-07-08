@extends('layout.master')
@section('title', 'Siakad | Mapel')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-file-document-box"></i>
        </span> Tambah Data Mapel
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Mata Pelajaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Mapel</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('mapel.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Mapel</label>
                            <input class="form-control" autocomplete="off" name="nama_mapel"
                                value="{{ old('nama_mapel') }}">
                            @error('nama_mapel')
                            <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select class="form-control" name="id_kelas">
                                <option disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $data)
                                <option value="{{ $data->id_kelas }}"
                                    {{ old('id_kelas') == $data->id_kelas ? 'selected' : ''}}>
                                    {{ $data->tingkat->nama_tingkat }}
                                    {{ $data->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilih Guru Pengajar</label>
                    <select class="form-control js-example-basic-single" name="nip">
                        <option disabled selected>Pilih Guru</option>
                        @foreach ($guru as $data)
                        <option value="{{ $data->nip }}" {{ old('nip') == $data->nip ? 'selected' : ''}}>
                            {{ $data->nama_guru }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-gradient-primary float-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

</script>
@endsection
