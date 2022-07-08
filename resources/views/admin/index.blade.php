@extends('layout.master')
@section('title', 'Siakad | Admin')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Admin
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Admin</h4>
        </div>
        <div class="card-body">
            <a class='btn btn-info  btn-gradient-info' href="{{ route('admin.create') }}"><i
                    class='mdi mdi-plus menu-icon'></i>
                Tambah Admin</a>
            <br><br>
            <table class="display cell-border comapct" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="20px"> No </th>
                        <th> Nama </th>
                        <th> Email </th>
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
            ajax: '{{ route('admin.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('admin.edit', ':id') }}" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                        <a href="#" class='btn btn-danger  btn-sm delete' data-id="${row.id}"><i
                                class="mdi mdi-delete"></i> </a>
                    `.replace(/:id/g, row.id);
                }
            }]
        });
    });

</script>
@if(Session::has('simpan'))
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
        var id = $(this).attr('data-id');
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
                    url: "{{ route('admin.destroy', ':id') }}".replace(':id', id),
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
