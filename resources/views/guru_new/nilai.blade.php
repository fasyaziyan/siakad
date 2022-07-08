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
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Detail Kelas</h6>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <th width="200px" height="30px">Nama Kelas</th>
                    <th width="10px">:</th>
                    <th width="400px">{{$mapel->kelas->nama_kelas}}</th>
                    <th width="200px">Jumlah Siswa</th>
                    <th width="10px">:</th>
                    <th>{{ $jml }} Siswa</th>
                </tr>
                <tr>
                    <th>Tingkat</th>
                    <th>:</th>
                    <th>{{$mapel->kelas->tingkat->nama_tingkat }}</th>
                    <th>P/L</th>
                    <th>:</th>
                    <th>{{ $siswa->where('jenis_kelamin', 'Laki-laki')->count() }} /
                        {{ $siswa->where('jenis_kelamin', 'Perempuan')->count() }}</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('nilai.store') }}" method="post" enctype='multipart/form-data'>
            @csrf
            <h4 class="card-title">Mata Pelajaran {{ $mapel->nama_mapel }}</h4>
            <table class="table table-bordered">
                    <tr style="background-color: #C1C1B7">
                        <th width="20px"><b> No </th>
                        <th><b> Nama Siswa </th>
                        <th width="100px" style="text-align: center"><b> Nilai </th>
                    </tr>
                @foreach ($detnilai as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <input type="hidden" name="id_mapel[]" value="{{ $mapel->id_mapel }}">
                    <input type="hidden" name="id_kuri[]" value="{{ $data->id_kuri }}">
                    <input type="hidden" name="id_kelas[]" value="{{ $data->id_kelas ?? '' }}">
                    <td style="font: 15px sans-serif;"><input type="hidden" name="nisn[]" value="{{ $data->nisn}}">{{ $data->nama}}</td>
                    <td><input type="text" class="form-control" name="nilai[]" value="{{ $data->nilai ?? '' }}" autocomplete="off" style="text-align: center"></td>
                </tr>
                @endforeach
            </table>
            <br>
            <button type="submit" class="btn btn-gradient-primary mr-2 float-right save">Submit Nilai</button>
        </form>
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
