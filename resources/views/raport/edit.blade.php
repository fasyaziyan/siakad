@extends('layout.master')
@section('title', 'Siakad | Rapot')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Edit Data Rapot
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('raport.index')}}">Rapot</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Rapot</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('raport.update', $rapot->id_rapot) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <br>
                <h4>Detail Raport</h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <select class="form-control" name="nisn" style="pointer-events:none; background-color: #b9b9bb;">
                                @foreach ($siswa as $data)
                                <option value="{{ $data->nisn }}" {{ $data->nisn == $rapot->nisn ? 'selected' : '' }}>
                                    {{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kurikulum</label>
                            {{-- <input class="form-control" disabled autocomplete="off" name="id_kuri" value="{{$rapot->kurikulum->tahun_ajaran}} Semester {{$rapot->kurikulum->semester}}"> --}}
                            <select class="form-control" name="id_kuri" style="pointer-events:none; background-color: #b9b9bb;" readonly>
                                @foreach ($kurikulum as $data)
                                <option value="{{ $data->id_kuri }}" {{ $data->id_kuri == $rapot->id_kuri ? 'selected' : '' }}>
                                    {{ $data->tahun_ajaran }} Semester {{ $data->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Edit Nilai Siswa</h4>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Al-Quran Hadits</label>
                            <input class="form-control" autocomplete="off" name="n_hadits" value="{{ $rapot->n_hadits }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Aqidah Akhlaq</label>
                            <input class="form-control" autocomplete="off" name="n_aqidah" value="{{ $rapot->n_aqidah }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fiqih</label>
                            <input class="form-control" autocomplete="off" name="n_fiqih" value="{{ $rapot->n_fiqih }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>SKI</label>
                            <input class="form-control" autocomplete="off" name="n_ski" value="{{ $rapot->n_ski }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PPKN</label>
                            <input class="form-control" autocomplete="off" name="n_pkn" value="{{ $rapot->n_pkn }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Indonesia</label>
                            <input class="form-control" autocomplete="off" name="n_bindo" value="{{ $rapot->n_bindo }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Arab</label>
                            <input class="form-control" autocomplete="off" name="n_barab" value="{{ $rapot->n_barab }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Inggris</label>
                            <input class="form-control" autocomplete="off" name="n_binggris" value="{{ $rapot->n_binggris }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Matematika</label>
                            <input class="form-control" autocomplete="off" name="n_matematika" value="{{ $rapot->n_matematika }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>IPA</label>
                            <input class="form-control" autocomplete="off" name="n_ipa" value="{{ $rapot->n_ipa }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>IPS</label>
                            <input class="form-control" autocomplete="off" name="n_ips" value="{{ $rapot->n_ips }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Seni Budaya</label>
                            <input class="form-control" autocomplete="off" name="n_sebud" value="{{ $rapot->n_sebud }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pendidikan Jasmani</label>
                            <input class="form-control" autocomplete="off" name="n_jasmani" value="{{ $rapot->n_jasmani }}">
                        </div>
                    </div>
                    @if ($rapot->siswa->kelas->nama_kelas == '1 A' or $rapot->siswa->kelas->nama_kelas == '1 B' )
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Prakarya</label>
                            <input class="form-control" autocomplete="off" name="n_prakarya" value="{{ $rapot->n_prakarya }}">
                        </div>
                    </div>
                    @elseif ($rapot->siswa->kelas->nama_kelas == '2 A' or $rapot->siswa->kelas->nama_kelas == '2 B' )
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Informatika</label>
                            <input class="form-control" autocomplete="off" name="n_tik" value="{{ $rapot->n_tik }}">
                        </div>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bahasa Jawa</label>
                            <input class="form-control" autocomplete="off" name="n_bjawa" value="{{ $rapot->n_bjawa }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" value="{{ $rapot->keterangan }}">{{ $rapot->keterangan }}</textarea>
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
</script>
@endsection
