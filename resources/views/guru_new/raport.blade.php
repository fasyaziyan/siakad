@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Daftar Mata Pelajaran
    </h3>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="display cell-border comapct" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th style="text-align: center">Aksi</th>
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
            ajax: '{{ route('raport.mapel') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center', 
                    width: '20px',
                },
                {
                    data: 'nama_mapel',
                    name: 'nama_mapel'
                },
                {
                    data: (data, type, row, meta) => {
                        return data.kelas.tingkat.nama_tingkat + '-' + data.kelas.nama_kelas
                    },
                    name: 'kelas.tingkat.nama_tingkat',
                    className: 'text-center'
                },
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                        <a href="{{ route('nilai.show', ':id_mapel') }}"
                            class='btn btn-outline-info btn-icon-text btn-sm'> Input Nilai <i
                                class="mdi mdi-information btn-icon-append"></i> </a>
                    `.replace(':id_mapel', row.id_mapel);
                }
            }]
        });
    });

</script>
@if (Session::has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ Session::get('success') }}',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
@endif
@endsection
