@extends('layout.master')
@section('title', 'Siakad | Detail Nilai')
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
        </span> Detail Nilai Mata Pelajaran
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table>
                <tr>
                    <th width="200px" height="30px">Nama Mata Pelajaran</th>
                    <th width="10px">:</th>
                    <th width="300px">{{ $mapel->nama_mapel }}</th>
                    <th width="200px">Guru Pengajar</th>
                    <th width="10px">:</th>
                    <th>{{ $mapel->guru->nama_guru }}</th>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <th>:</th>
                    <th>{{ $mapel->kelas->tingkat->nama_tingkat }}-{{ $mapel->kelas->nama_kelas }}</th>
                    <th>Jumlah Siswa</th>
                    <th>:</th>
                    <th>{{ $siswa->count() }}</th>
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
                    <th width="50px" style="text-align:center">NISN</th>
                    <th>Nama Siswa</th>
                    <th style="text-align:center">Nilai</th>
                </tr>
                @foreach ($nilai as $data)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $data->nisn }}</td>
                    <td>{{ $data->nama }}</td>
                    @if ($data->nilai == null)
                    <td style="text-align: center; border: 2px solid red; background-color: #FFCECE" width="10px">{{ $data->nilai }}</td>
                    @else
                    <td style="text-align:center" width="10px">{{ $data->nilai }}</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endsection
