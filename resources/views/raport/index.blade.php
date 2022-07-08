@extends('layout.master')
@section('title', 'Siakad | Rapot')
@section('content')
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
            <a href="#" class="btn btn-gradient-danger btn-fw" data-toggle="modal" data-target="#ModalCreate"><i
                    class='mdi mdi-alert-circle-outline'></i> Nilai Kurang</a>
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
                    <td>{{ $rapot->siswa->kelas->nama_kelas }}</td>
                    <td>{{ $rapot->kurikulum->tahun_ajaran }} Semester {{$rapot->kurikulum->semester }}</td>
                    <td>
                        {{-- <form action="{{ route('raport.destroy', $rapot->id_rapot) }}" method="post"> --}}
                        <a href="{{ route('raport.edit', $rapot->id_rapot) }}" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                        <a href="{{ route('raport.cetakpdf', $rapot->id_rapot) }}" class='btn btn-info btn-sm'><i
                                class="mdi mdi-cloud-print"></i> </a>
                        @csrf
                        {{-- @method('DELETE') --}}
                        <a href="#" action="{{ route('raport.destroy', $rapot->id_rapot) }}"
                            class='btn btn-danger btn-sm swal-confirm' data-id="{{ $rapot->id_rapot }}" id="coba">
                            <i class="mdi mdi-delete"></i>
                        </a>
                        {{-- </form> --}}
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
<script>
    $(".swal-confirm").click(function (e) {
        var rapotid = $(this).attr('data-id')
        var url = "{{ route('raport.destroy', ":rapotid ") }}"
        var url1 = "{{ route('raport.index') }}"
        url = url.replace(':rapotid', rapotid)
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang sudah terhapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                })
                ///creater function reload page
                location.reload();
            } else {}
        })
    });
</script>
@endsection
