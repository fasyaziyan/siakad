@extends('layout.master')
@section('page-name','Dashboard')
@section('content')
@include('layout.style_dashboard')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <div class="d-flex flex-row align-items-center">
            <i class="mdi mdi-av-timer icon-md text-danger"></i>
            <h6 class="mb-0 ml-1"> {{ $date }}</h6>
        </div>
    </nav>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card grid-margin" style="background-color: rgb(181, 211, 245);">
            <div class="card-body">
                <div class="d-lg-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h4 style="color: #075fa5">Sistem Informasi Akademik E-Rapot</h4>
                        <h5 class="m-0" style="width: 80%">E-Raport adalah sebuah aplikasi sistem penilaian berbasis Web
                            yang digunakan untuk mengubah pola penilaian manual dari Guru terhadap Peserta Didik ke pola
                            digital.</h5>
                    </div>
                    <img src="{{ asset('images/Logo2.png') }}" alt="profile" class="ecommerce-banner-image-position"
                        style="width: 230px; position: absolute; right: 40px; bottom: 0;">
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::guard('guru')->check())
@if ($jadwal == !null)
<div class="row">
    <div class="col-sm-12">
        <div class="card grid-margin" style="background-color: rgb(221, 247, 128);">
            <div class="card-body" style="padding: 20px;">
                <div class="d-lg-flex justify-content-between align-items-center">
                    <div>
                        <h4 style="color: #075fa5">{{ $jadwal->judul }}</h4>
                        <h5>{{ $jadwal->keterangan }}</h5>
                        <h5>Tanggal Mulai : {{ $jadwal->tanggal_mulai}}</h5>
                        <h5>Tanggal Selesai : {{ $jadwal->tanggal_selesai }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics card1">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account-multiple text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Jumlah Siswa</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $siswa }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics card1">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-worker text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Jumlah Guru</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $guru }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics card1">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-book-open-page-variant text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Jumlah Mapel</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $mapel}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics card1">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-bank text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Jumlah Kelas</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $kelas}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <h4 class="card-title">Grafik Siswa Setiap Kelas</h4>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a type="button" class="btn btn-success float-right" id="cari">Filter</a>
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Peringkat Kelas</h4>
                    </div>
                    <div class="col-md-">
                        <select class="form-control" name="id_kelas">
                            <option selected disabled>Pilih Kelas</option>
                            @foreach ($data_kelas as $data)
                            <option value="{{ $data->id_kelas }}"
                                {{ old('id_kelas') == $data->id_kelas ? 'selected' : ''}}>
                                {{ $data->tingkat->nama_tingkat }} -
                                {{ $data->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="mytable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama </th>
                                <th> Total Nilai </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var list_kelas = {!! $list_kelas !!};
    var siswa_kelas_count = {!! $siswa_kelas_count !!};

    const data = {
        labels: list_kelas.map(item => item.nama_tingkat + '-' + item.nama_kelas),
        datasets: [{
            label: 'Jumlah Siswa',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1,
            data: siswa_kelas_count
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>
<script>
    $(document).ready(function(){
        $('#mytable').DataTable({
            "lengthChange": false,
            "searching": false,
        });
    });
    $('#cari').click(function () {
        var id_kelas = $('select[name="id_kelas"]').val();
        $.ajax({
            url: '{{ route('peringkat') }}',
            type: 'GET',
            data: {
                id_kelas: id_kelas,
            },
            success: function (data) {
                //destroy datatable
                $('#mytable').DataTable().destroy();
                var table = $('#mytable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "Tidak Ada Data Tersedia"
                    }
                });
                table.clear().draw();
                var no = 1;
                $.each(data, function (key, value) {
                    table.row.add([
                        no,
                        key,
                        value
                    ]).draw();
                    no++;
                });
            }
        });
    });

</script>
@endsection
