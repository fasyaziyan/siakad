@extends('layout.master')
@section('title', 'Siakad | Raport')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Raport Siswa
    </h3>
</div>
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Raport Siswa</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label><b> Nilai KKM </b></label>
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="kkm" name="set_kkm" value="{{ $kkm }}" style="text-align: center" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <a type="button" class="btn btn-success btn-icon-text simpan_kkm"> Simpan <i class="mdi mdi-assistant btn-icon-append"></i></a>
                    </div>
                </div>
            </div>
            <br>
            <table class="display compact cell-border" id="table">
                <thead>
                    <tr>
                        <th width="10px"><b> No </th>
                        <th><b> Nama </th>
                        <th style="text-align:center"><b> Kelas </th>
                        <th style="text-align:center"><b> Aksi </th>
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
            ajax: '{{ route('nilai.show2') }}',
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
                    data: (data, type, row, meta) => {
                        return data.kelas.tingkat.nama_tingkat + '-' + data.kelas
                            .nama_kelas
                    },
                    name: 'kelas.tingkat.nama_tingkat',
                    className: 'text-center'
                }
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `<a href="{{ route('nilai.showadmin', ':nisn') }}" class="btn btn-outline-info btn-icon-text btn-sm"><i class="mdi mdi-information"></i>Detail Raport</a>
                                `.replace(':nisn', row.nisn);
                }
            }]
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('.simpan_kkm').on('click', function() {
            var kkm = $('#kkm').val();
            if (kkm == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kolom KKM tidak boleh kosong!',
                })
            } else {
                $.ajax({
                    url: "{{ route('nilai.setkkm') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        set_kkm: kkm
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'KKM berhasil diubah!',
                        })
                    }
                });
            }
        });
    });
    </script>
@endsection
