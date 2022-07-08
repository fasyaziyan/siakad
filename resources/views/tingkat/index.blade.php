@extends('layout.master')
@section('title', 'Siakad | Tingkat')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Tingkat
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tingkat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Tingkat</h4>
        </div>
        <div class="card-body">
            @if($tingkat)
            <a class='btn btn-info btn-gradient-info tingkat' href="#"><i class='mdi mdi-plus menu-icon'></i>
                Tambah Tingkat</a>
            @else
            <a class='btn btn-info btn-gradient-info create' href="{{ route('tingkat.create') }}"><i class='mdi mdi-plus menu-icon'></i>
                Tambah Tingkat</a>
            @endif
            <br><br>
            <table class="display compact cell-border" id="table">
                <thead>
                    <tr>
                        <th width="20px"> No </th>
                        <th> ID Tingkat </th>
                        <th> Nama Tingkat </th>
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
            ajax: '{{ route('tingkat.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: true,
                    className: 'text-center'
                },
                {
                    data: 'id_tingkat',
                    name: 'id_tingkat',
                    className: 'text-center'
                },
                {
                    name: 'nama_tingkat',
                    data: 'nama_tingkat',
                    className: 'text-center'
                }
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('tingkat.edit', ':id_tingkat') }}" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                    <a href="#" class='btn btn-danger  btn-sm delete' data-id="${row.id_tingkat}"><i class="mdi mdi-delete"></i> </a>
                    `.replace(/:id_tingkat/g, row.id_tingkat);
                }
            }]
        });
    });

</script>
<script>
    $(document).on('click', '.delete', function () {
        var id_tingkat = $(this).attr('data-id');
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
                    url: "{{ route('tingkat.destroy', ':id_tingkat') }}".replace(
                        ':id_tingkat',
                        id_tingkat),
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
<script>
    $(document).on('click', '.tingkat', function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hanya dapat menambahkan data 3 tingkat!',
        })
    });
</script>
@endsection
