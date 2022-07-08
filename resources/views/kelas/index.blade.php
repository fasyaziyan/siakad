@extends('layout.master')
@section('title', 'Siakad | Kelas')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Kelas
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kelas</h4>
        </div>
        <div class="card-body">
            <a class='btn btn-info  btn-gradient-info' href="{{ route('kelas.create') }}"><i
                    class='mdi mdi-plus menu-icon'></i>
                Tambah Kelas</a>
            <br><br>
            <table class="display compact cell-border" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="30px"> No </th>
                        <th style="text-align: center;"> Nama Kelas </th>
                        <th style="text-align: center;"> Tahun / Semester </th>
                        <th> Wali Kelas </th>
                        <th style="text-align: center;"> Aksi </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
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
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('kelas.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: (data, type, row, meta) => {
                        return data.tingkat.nama_tingkat + '-' + data.nama_kelas
                    },
                    name: 'kelas.nama_kelas',
                    className: 'text-center'
                },
                {
                    data: (data, type, row, meta) => {
                        return data.kurikulum.tahun_ajaran + ' ' + data.kurikulum.semester
                    },
                    name: 'kurikulum.tahun_ajaran',
                    className: 'text-center'
                },
                {
                    data: 'guru.nama_guru',
                    name: 'guru.nama_guru'
                }
            ],
            columnDefs: [{
                targets: 4,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('kelas.edit', ':id_kelas') }}" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                        <a href="{{ route('kelas.detail_kelas', ':id_kelas') }}"
                            class='btn btn-gradient-info btn-sm'><i class="mdi mdi-information"></i> </a>
                        <a href="#" class='btn btn-danger  btn-sm delete' data-id="${row.id_kelas}"><i
                                class="mdi mdi-delete"></i> </a>
                    `.replace(/:id_kelas/g, row.id_kelas);
                }
            }]
        });
    });

</script>
<script>
    $(document).on('click', '.delete', function () {
        var id_kelas = $(this).attr('data-id');
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
                    url: "{{ route('kelas.destroy', ':id_kelas') }}".replace(
                        ':id_kelas',
                        id_kelas),
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
