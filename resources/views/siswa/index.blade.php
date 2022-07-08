@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-box menu-icon"></i>
        </span> Siswa
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Siswa</h4>
        </div>
        <div class="card-body">
            <a class='btn btn-info  btn-gradient-info' href="{{ route('siswa.create') }}"><i
                    class='mdi mdi-plus menu-icon'></i>
                Tambah Siswa</a>
            <br><br>
            <table class="display cell-border compact" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="30px"> No </th>
                        <th> Nama </th>
                        <th> Jenis Kelamin </th>
                        <th> Kelas </th>
                        <th> Aksi </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('siswa.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: (data, type, row, meta) => {
                        return data.kelas.tingkat.nama_tingkat + '-' + data.kelas.nama_kelas
                    },
                    name: 'kelas.tingkat.nama_tingkat',
                    className: 'text-center'
                }
            ],
            columnDefs: [{
                targets: 4,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href=":edit" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                        <a href="#" class='btn btn-danger  btn-sm delete' data-id="${row.nisn}"><i
                                class="mdi mdi-delete"></i> </a>
                    `.replace(':edit', `{{ route('siswa.edit', 'nisn') }}`.replace('nisn', row.nisn));
                }
            }]
        });
    });

</script>
@if (Session::has('simpan'))
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
@elseif(Session::has('edit'))
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
        title: 'Data Berhasil Diubah'
    })

</script>
@endif
<script>
    $(document).on('click', '.delete', function () {
        var nisn = $(this).attr('data-id');
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ route('siswa.destroy', ':nisn') }}".replace(':nisn',
                        nisn),
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        '_method': 'POST'
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
            }
        })
    });

</script>
@endsection
