@extends('layout.master')
@section('title', 'Siakad | Siswa')
@section('content')
<style>
    .table,
    .table th,
    .table td {
        border: 1px solid rgb(136, 133, 133);
        border-collapse: collapse;
        color: rgb(0, 0, 0);
    }

</style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account-card-details menu-icon"></i>
        </span> Detail Raport Siswa
    </h3>
</div>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table>
                    <tr>
                        <th width="200px" height="30px">NISN</th>
                        <th width="10px">:</th>
                        <th width="400px">{{ $siswa->nisn }}</th>
                        <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                        <th width="200px">Kelas</th>
                        <th width="10px">:</th>
                        <th>{{ $siswa->kelas->tingkat->nama_tingkat }} - {{ $siswa->kelas->nama_kelas }}</th>
                        <input type="hidden" name="id_kelas" value="{{ $siswa->id_kelas }}">
                    </tr>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>:</th>
                        <th>{{ $siswa->nama }}</th>
                        <th>Semester</th>
                        <th>:</th>
                        <th>{{ $siswa->kelas->kurikulum->semester }}</th>
                        <input type="hidden" name="id_kuri" value="{{ $siswa->kelas->id_kuri }}">
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr style="background-color: #C1C1B7">
                        <th width="20px">No</th>
                        <th width="50px" style="text-align:center">Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th width="40px" style="text-align:center">KKM</th>
                        <th width="40px" style="text-align:center">Nilai</th>
                    </tr>
                    @foreach ($nilai as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->id_mapel }}</td>
                        <td>{{ $data->nama_mapel}}</td>
                        <td style="text-align:center">{{ $kkm }}</td>
                        <td style="text-align:center">{{ $data->nilai ?? ''}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" style="text-align: center; background-color: #C1C1B7">Jumlah</th>
                        <th style="text-align: center">{{ $total }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: center; background-color: #C1C1B7">Rata Rata</th>
                        <th style="text-align: center">{{ $rata_rata}}</th>
                    </tr>
                </table>
                <div class="form-group">
                    <label>Catatan Wali Kelas</label>
                    <textarea class="form-control" autocomplete="off" name="keterangan"
                        value="{{ $data->keterangan }}">{{ $data->keterangan }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sakit</label>
                            <input class="form-control" type="text" autocomplete="off" name="sakit"
                                value="{{ $data->sakit }}" style="text-align: center">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Izin</label>
                            <input class="form-control" type="text" autocomplete="off" name="izin"
                                value="{{ $data->izin }}" style="text-align: center">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Alfa</label>
                            <input class="form-control" type="text" autocomplete="off" name="alpa"
                                value="{{ $data->alpa }}" style="text-align: center">
                        </div>
                    </div>
                </div>
                <a type="button" class="btn btn-primary btn-icon-text float-right simpan_ket">Simpan</a>
                <a href="{{ route('wali.cetak', $siswa->nisn) }}" type="button"
                    class="btn btn-success btn-icon-text float-right cetak" style="margin-right: 10px"> Cetak <i
                        class="mdi mdi-printer btn-icon-append"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $('.simpan_ket').click(function () {
        var nisn = $('input[name="nisn"]').val();
        var id_kelas = $('input[name="id_kelas"]').val();
        var id_kuri = $('input[name="id_kuri"]').val();
        var keterangan = $('textarea[name="keterangan"]').val();
        var sakit = $('input[name="sakit"]').val();
        var izin = $('input[name="izin"]').val();
        var alpa = $('input[name="alpa"]').val();
        console.log(keterangan);
        $.ajax({
            url: '{{ route('wali.set_catatan') }}',
            method: 'post',
            data: {
                nisn: nisn,
                id_kelas: id_kelas,
                id_kuri: id_kuri,
                keterangan: keterangan,
                sakit: sakit,
                izin: izin,
                alpa: alpa,
                '_token': "{{ csrf_token() }}",
            },
            success: function (data) {
                Swal.fire({
                    title: 'Berhasil',
                    icon: 'success',
                    text: 'Raport Berhasil Disimpan',
                    timer: 1500,
                    showConfirmButton: false,
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    title: 'Gagal',
                    icon: 'error',
                    text: 'Raport Gagal Disimpan',
                    timer: 1500,
                    showConfirmButton: false,
                })
            }
        });
    });

</script>
@endsection
