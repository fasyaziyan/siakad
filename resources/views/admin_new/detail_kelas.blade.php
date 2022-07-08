@extends('layout.master')
@section('title', 'Siakad | Kelas')
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
        </span> Detail Kelas {{ $kelas->tingkat->nama_tingkat }} - {{ $kelas->nama_kelas }}
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table>
                <tr>
                    <th width="200px" height="30px">Nama Kelas</th>
                    <th width="10px">:</th>
                    <th width="400px">{{ $kelas->tingkat->nama_tingkat }} - {{ $kelas->nama_kelas }}</th>
                    <th width="200px">Jumlah Siswa</th>
                    <th width="10px">:</th>
                    <th>{{ $siswa->count() }} Siswa</th>
                </tr>
                <tr>
                    <th>Wali Kelas</th>
                    <th>:</th>
                    <th>{{ $kelas->guru->nama_guru}}</th>
                    <th>P/L</th>
                    <th>:</th>
                    <th>{{ $siswa->where('jenis_kelamin', 'Laki-laki')->count() }} /
                        {{ $siswa->where('jenis_kelamin', 'Perempuan')->count() }}</th>
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
                </tr>
                @foreach ($siswa as $siswa)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama }}</td>
                </tr>
                @endforeach
            </table>
            <a href="{{ route('kelas.absen', $kelas->id_kelas)}}" class='btn btn-success btn-icon-text btn-fw float-right'> Cetak Absen <i
                    class="mdi mdi-cloud-print btn-icon-append"></i> </a>
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
