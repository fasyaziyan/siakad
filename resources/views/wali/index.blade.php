@extends('layout.master')
@section('title', 'Siakad | Nilai & Raport')
@section('content')
<style>
    div.hide {
        display: none;
    }

</style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Raport Siswa Per Kelas
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label>Pilih Kelas</label>
                    <select class="form-control" id="id_kelas">
                        <option disabled selected>Pilih Kelas</option>
                        @foreach ($kelas as $data)
                        <option value="{{ $data->id_kelas }}">{{ $data->tingkat->nama_tingkat }} -
                            {{ $data->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6" style="margin-top: 30px">
                    <a class="btn btn-success btn-md" id="cari">Cari</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body hide">
            <div class="tampung">
                <table class="display compact cell-border" id="table">
                    <thead>
                        <tr>
                            <th >No</th>
                            <th style="text-align:center">NISN</th>
                            <th style="text-align:center">Nama Siswa</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#cari').click(function () {
            $('.card-body').removeClass('hide');
            var id_kelas = $('#id_kelas').val();
            $('#table').DataTable().destroy();
            $('#table').DataTable({
                ajax: '{{ route('wali.index_kelas',':id_kelas') }}'.replace(':id_kelas', id_kelas),
                processing: true,
                serverSide: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: true,
                        className: 'text-center',
                        width: '10px',
                    },
                    {
                        data: 'nisn',
                        name: 'nisn',
                        orderable: false,
                        searchable: true,
                        width: '40px',
                        className: 'text-center',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                        searchable: true,
                    }
                ],
                columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `
                    <a href="{{ route('wali.profil_siswa', ':nisn') }}" class='btn btn-warning'><i class="mdi mdi-account"></i></a>
                    <a href="{{ route('wali.detail_rapot', ':nisn') }}" class='btn btn-primary'><i class="mdi mdi-eye"></i></a>
                    `.replace(/:nisn/g, row.nisn);
                }
            }]
            });
        });
    });

</script>
@endsection
