@extends('layout.master')
@section('title', 'Siakad | Kurikulum')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Kurikulum
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kurikulum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kurikulum</h4>
        </div>
        <div class="card-body">
            <a class='btn btn-info  btn-gradient-info' href="{{ route('kurikulum.create') }}"><i
                    class='mdi mdi-plus menu-icon'></i>
                Tambah Kurikulum</a>
            <br><br>
            <table class="display compact cell-border" id="table">
                <thead>
                    <tr>
                        <th width="20px"> No </th>
                        <th> Tahun Ajaran </th>
                        <th style="text-align: center"> Semester </th>
                        <th> Aksi </th>
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
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('kurikulum.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'text-center' },
                { data: 'tahun_ajaran', name: 'tahun_ajaran', className: 'text-center'},
                { data: 'semester', name: 'semester', className: 'text-center', render: function(data, type, row) {
                    if (data == 1) {
                        return 'Semseter Ganjil ';
                    } else {
                        return 'Semester Genap';
                    }
                } },
                { data: 'action', name: 'action', searchable: false, orderable: false, className: 'text-center' }
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('kurikulum.edit', ':id_kuri') }}" class='btn btn-warning  btn-sm'><i
                                class="mdi mdi-table-edit"></i> </a>
                        <a href="#" class='btn btn-danger  btn-sm delete' data-id="${row.id_kuri}"><i
                                class="mdi mdi-delete"></i> </a>
                    `.replace(/:id_kuri/g, row.id_kuri);
                }
            }]
        });
    });
    </script>
    <script>
        $(document).on('click', '.delete', function () {
            var id_kuri = $(this).attr('data-id');
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
                        url: "{{ route('kurikulum.destroy', ':id_kuri') }}".replace(
                            ':id_kuri',
                            id_kuri),
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
