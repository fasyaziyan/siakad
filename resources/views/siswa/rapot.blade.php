@extends('layout.master')
@section('title', 'Siakad | Rapot')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Daftar Raport
    </h3>
</div>

<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="display cell-border comapct" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: center">Tahun Ajaran</th>
                        <th style="text-align: center">Semester</th>
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
            ajax: '{{ route('siswa.index_rapot') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center', 
                    width: '20px',
                },
                {
                    data: 'kurikulum.tahun_ajaran',
                    name: 'kurikulum.tahun_ajaran',
                    className: 'text-center',
                },
                {
                    data: 'kurikulum.semester',
                    name: 'kurikulum.semester',
                    className: 'text-center',
                },
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('siswa.rapot_cetak', ':id_kuri') }}"  class="btn btn-success btn-icon-text btn-sm"><i class="mdi mdi-printer btn-icon-append"></i>Cetak</a>
                    <a href="{{ route('siswa.rapot_detail', ':id_kuri') }}" class='btn btn-primary btn-icon-text btn-sm'><i class="mdi mdi-information-outline btn-icon-append"></i>Detail</a>
                    `.replace(/:id_kuri/g, row.id_kuri);
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
