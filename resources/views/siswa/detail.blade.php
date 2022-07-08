@extends('layout.master')
@section('title', 'Siakad | Rapot')
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
                    <th width="200px">Kelas</th>
                    <th width="10px">:</th>
                    <th>{{ $siswa->kelas->tingkat->nama_tingkat }} - {{ $siswa->kelas->nama_kelas }}</th>
                </tr>
                <tr>
                    <th>Nama Siswa</th>
                    <th>:</th>
                    <th>{{ $siswa->nama }}</th>
                    <th>Semester</th>
                    <th>:</th>
                    <th>{{ $siswa->kelas->kurikulum->semester }}</th>
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
                    <td style="text-align:center">{{ $data->nilai ?? ''}}</td>
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
                <textarea class="form-control" autocomplete="off" name="keterangan" value="{{ $data->keterangan }}" disabled>{{ $data->keterangan }}</textarea>
            </div>
        </div>
    </div>
</div>
@endsection
