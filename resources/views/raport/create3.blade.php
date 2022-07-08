@extends('layout.master')
@section('title', 'Siakad | Rapot')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tambah Data Rapot
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rapor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Rapot</li>
        </ol>
    </nav>
</div>

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2)=='create' ) active @endif" href="{{ route('raport.create') }}">Rapot Kelas 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2)=='create2' ) active @endif" href="{{ route('raport.create2') }}">Rapot Kelas 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2)=='create3' ) active @endif" href="{{ route('raport.create3') }}">Rapot Kelas 3</a>
    </li>
  </ul>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('raport.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <br>
                <h4>Detail Raport</h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <select class="form-control js-example-basic-single" name="nisn">
                                <option value="">Pilih Siswa</option>
                                @foreach ($siswa as $data)
                                <option value="{{ $data->nisn }}">{{ $data->nama }} {{ $data->kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kurikulum</label>
                            <select class="form-control js-example-basic-single" name="id_kuri" id="example-text-input">
                                <option value="">Pilih Kurikulum</option>
                                @foreach ($kurikulum as $data)
                                <option value="{{ $data->id_kuri }}">{{ $data->tahun_ajaran }} Semester {{ $data->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Input Nilai Siswa</h4>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Al-Quran Hadits</label>
                            <input class="form-control" autocomplete="off" name="n_hadits" value="{{ old('n_hadits') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Aqidah Akhlaq</label>
                            <input class="form-control" autocomplete="off" name="n_aqidah" value="{{ old('n_aqidah') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fiqih</label>
                            <input class="form-control" autocomplete="off" name="n_fiqih" value="{{ old('n_fiqih') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>SKI</label>
                            <input class="form-control" autocomplete="off" name="n_ski" value="{{ old('n_ski') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PPKN</label>
                            <input class="form-control" autocomplete="off" name="n_pkn" value="{{ old('n_pkn') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Indonesia</label>
                            <input class="form-control" autocomplete="off" name="n_bindo" value="{{ old('n_bindo') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Arab</label>
                            <input class="form-control" autocomplete="off" name="n_barab" value="{{ old('n_barab') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Inggris</label>
                            <input class="form-control" autocomplete="off" name="n_binggris" value="{{ old('n_binggris') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Matematika</label>
                            <input class="form-control" autocomplete="off" name="n_matematika" value="{{ old('n_matematika') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>IPA</label>
                            <input class="form-control" autocomplete="off" name="n_ipa" value="{{ old('n_ipa') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>IPS</label>
                            <input class="form-control" autocomplete="off" name="n_ips" value="{{ old('n_ips') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Seni Budaya</label>
                            <input class="form-control" autocomplete="off" name="n_sebud" value="{{ old('n_sebud') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pendidikan Jasmani</label>
                            <input class="form-control" autocomplete="off" name="n_jasmani" value="{{ old('n_jasmani') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Jawa</label>
                            <input class="form-control" autocomplete="off" name="n_bjawa" value="{{ old('n_bjawa') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" value="{{ old('keterangan') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2 float-right">Submit</button>
        </div>
    </div>
    </form>
</div>
@endsection()
@section('script')
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D/MM/YYYY',
        toString(date, format) {
            // you should do formatting based on the passed format,
            // but we will just return 'D/M/YYYY' for simplicity
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }
    });
    $(document).ready(function () {
        // $.fn.select2.defaults.set("theme", "classic");
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
