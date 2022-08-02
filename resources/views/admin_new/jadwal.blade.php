@extends('layout.master')
@section('title', 'Siakad | Jadwal Input Nilai')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Jadwal Input Nilai
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jadwal.store') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group input-daterange d-flex align-items-center">
                        <input type="date" class="form-control" name="tanggal_mulai">
                        <div class="input-group-addon mx-2">Sampai</div>
                        <input type="date" class="form-control" name="tanggal_selesai">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
        </div>
        </form>
    </div>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="display compact cell-border" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;"> No </th>
                        <th style="text-align: center;"> Judul </th>
                        <th style="text-align: center;"> Keterangan </th>
                        <th style="text-align: center"> Tanggal Mulai </th>
                        <th style="text-align: center"> Tanggal Selesai </th>
                        <th style="text-align: center;"> Status </th>
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
            ajax: '{{ route('nilai.jadwal') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'tanggal_mulai',
                    name: 'tanggal_mulai',
                    className: 'text-center'
                },
                {
                    data: 'tanggal_selesai',
                    name: 'tanggal_selesai',
                    className: 'text-center'
                },
                {
                    render: function (data, type, row) {
                        if (row.status == 'Active') {
                            return `<div class="dropdown">
                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Active </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item update" data-id="${row.id}">Ubah Status</a>
                                            </div>
                                    </div>`;
                        }if (row.status == 'Inactive') {
                            return `<div class="dropdown">
                                        <button class="btn btn-warning btn-sm dropdown-toggle" @if($jadwal == true) Disabled @endif type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Inactive </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item update" data-id="${row.id}">Ubah Status</a>
                                            </div>
                                    </div>`;
                        }else {
                            return `<div class="dropdown">
                                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Disabled </button>
                                             <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item delete" data-id="${row.id}"">Hapus</a>
                                            </div>
                                     </div>`;
                        }
                    },
                    className: 'text-center'
                },
            ]
        });
    });

</script>
<script>
    $(document).on('click', '.update', function () {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Mengubah Status?',
            text: "Data yang diubah tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ubah!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ route('jadwal.update', ':id') }}".replace(
                        ':id',
                        id),
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        '_method': 'POST'
                    },
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Diubah',
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
                    url: "{{ route('jadwal.delete', ':id') }}".replace(
                        ':id',
                        id),
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
@if (Session::has('success'))
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
        title: 'Jadwal berhasil ditambahkan'
    })

</script>
@endif
@endsection