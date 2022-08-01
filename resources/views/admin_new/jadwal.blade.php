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
                        <th style="text-align: center;" width="30px"> No </th>
                        <th style="text-align: center;"> Judul </th>
                        <th style="text-align: center;"> Keterangan </th>
                        <th> Tanggal Mulai </th>
                        <th> Tanggal Selesai </th>
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
                    name: 'tanggal_mulai'
                },
                {
                    data: 'tanggal_selesai',
                    name: 'tanggal_selesai'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ]
        });
    });

</script>
@endsection