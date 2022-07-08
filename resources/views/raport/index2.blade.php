@extends('layout.master')
@section('title', 'Siakad | Rapot')
@section('content')
@if (Auth::guard('siswa')->user())
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Rapot
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rapot</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Rapot</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> No </th>
                        <th> Nama Siswa </th>
                        <th> Kelas </th>
                        <th> Tahun Ajaran </th>
                        <th> Aksi </th>
                    </tr>
                </thead>
                @foreach ($rapot as $rapot)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rapot->siswa->nama }}</td>
                    <td>{{ $rapot->siswa->kelas->nama_kelas }}</td>
                    <td>{{ $rapot->kurikulum->tahun_ajaran }} Semester {{$rapot->kurikulum->semester }}</td>
                    <td>
                            <a href="{{ route('raport.cetakpdf', $rapot->id_rapot) }}" class='btn btn-info btn-sm'><i
                                    class="mdi mdi-printer"></i> </a>
                    </td>
                </tr>
                @endforeach
                @forelse($rapot as $rapot)
                @empty
                <tr class='text-center'>
                    <td colspan="6">Tidak ada data</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@else
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Rapot
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rapot</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Rapot</h4>
        </div>
        <div class="card-body">
            <a class='btn btn-info  btn-gradient-info' href="{{ route('raport.create') }}"><i
                    class='mdi mdi-plus menu-icon'></i>
                Tambah Rapot</a>
            <a href="#" class="btn btn-gradient-danger btn-fw" data-toggle="modal" data-target="#ModalCreate"><i class='mdi mdi-alert-circle-outline'></i> Nilai Kurang</a>
            <br><br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> No </th>
                        <th> Nama Siswa </th>
                        <th> Kelas </th>
                        <th> Tahun Ajaran </th>
                        <th> Aksi </th>
                    </tr>
                </thead>
                @foreach ($rapot as $rapot)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rapot->siswa->nama }}</td>
                    <td>{{ $rapot->id_kuri }}</td>
                    <td>{{ $rapot->kurikulum->tahun_ajaran }} Semester {{$rapot->kurikulum->semester }}</td>
                    <td>
                        <form action="{{ route('raport.destroy', $rapot->id_rapot) }}" method="post">
                            <a href="{{ route('raport.edit', $rapot->id_rapot) }}" class='btn btn-warning  btn-sm'><i
                                    class="mdi mdi-table-edit"></i> </a>
                            <a href="{{ route('raport.cetakpdf', $rapot->id_rapot) }}" class='btn btn-info btn-sm'><i
                                    class="mdi  mdi-cloud-print"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-danger  btn-sm'><i
                                    class="mdi mdi-delete "></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @forelse($rapot as $rapot)
                @empty
                <tr class='text-center'>
                    <td colspan="6">Tidak ada data</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endif
@endsection
@include('modal.nilai')
@section('script')
@if(Session::has('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Data Berhasil Ditambah'
    })
</script>
@endif
@endsection
