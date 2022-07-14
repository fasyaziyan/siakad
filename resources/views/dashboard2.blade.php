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
            <h6 class="mb-0 ml-1" id="date_time"> {{ $date }}</h6>
        </div>
    </nav>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card grid-margin" style="background-color: #f3d69d;">
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
        <h4 class="card-title">Grafik Nilai Rata-Rata Mapel</h4>
        <canvas id="myChart"></canvas>
    </div>
</div>
@endsection
@section('script')
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var mapel = {!! $mapel !!};
    var nilai_rata = {!! $nilai_rata !!};
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: mapel,
            datasets: [{
                label: 'Nilai Rata-Rata',
                data: nilai_rata,
                backgroundColor: [
                    'rgba(236, 236, 49, 0.5)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 156, 34, 0.5)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 239, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    type: 'linear',
                }
            }
        }
    });
</script>
<script>
    setInterval(function () {
        $('#date_time').load(' #date_time');
    }, 60000);
</script>
@endsection