@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<style>
    .table, .table th, .table td {
        border: 1px solid rgb(136, 133, 133);
        border-collapse: collapse;
        color: rgb(0, 0, 0);
    }
    </style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Detail Raport Siswa
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table>
                <tr>
                    <th width="200px" height="30px">NISN</th>
                    <th width="10px">:</th>
                    <th width="400px">{{ $siswa->nisn }}</th>
                    <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                    <th width="200px">Kelas</th>
                    <th width="10px">:</th>
                    <th>{{ $siswa->kelas->tingkat->nama_tingkat }} - {{ $siswa->kelas->nama_kelas }}</th>
                    <input type="hidden" name="id_kelas" value="{{ $siswa->id_kelas }}">
                </tr>
                <tr>
                    <th>Nama Siswa</th>
                    <th>:</th>
                    <th>{{ $siswa->nama }}</th>
                    <th>Semester</th>
                    <th>:</th>
                    <th>{{ $siswa->kelas->kurikulum->semester }}</th>
                    <input type="hidden" name="id_kuri" value="{{ $siswa->kelas->id_kuri }}">
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr style="background-color: #C1C1B7">
                    <th width="20px">No</th>
                    <th width="50px" style="text-align:center">Kode Mapel</th>
                    <th>Nama Mapel</th>
                    <th width="40px" style="text-align:center">KKM</th>
                    <th width="40px" style="text-align:center">Nilai</th>
                </tr>
                @foreach ($nilai as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->id_mapel }}</td>
                    <td>{{ $data->nama_mapel}}</td>
                    <td style="text-align:center">{{ $kkm }}</td>
                    @if ($data->nilai == null)
                    <td style="text-align: center; border: 2px solid red; background-color: #FFCECE"></td>
                    @else
                    <td style="text-align:center">{{ $data->nilai }}</td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" style="text-align: center; background-color: #C1C1B7">Jumlah</th>
                    <th style="text-align: center">{{ $total }}</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center; background-color: #C1C1B7">Rata Rata</th>
                    <th style="text-align: center">{{ $rata_rata}}</th>
                </tr>
            </table>
            <div class="form-group">
                <label>Catatan Wali Kelas</label>
                <textarea class="form-control" autocomplete="off" name="keterangan" disabled>{{ $data->keterangan }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sakit</label>
                        <input class="form-control" type="text" autocomplete="off" name="sakit"
                            value="{{ $data->sakit }}" style="text-align: center" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Izin</label>
                        <input class="form-control" type="text" autocomplete="off" name="izin"
                            value="{{ $data->izin }}" style="text-align: center" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Alfa</label>
                        <input class="form-control" type="text" autocomplete="off" name="alpa"
                            value="{{ $data->alpa }}" style="text-align: center" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
