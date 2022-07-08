<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p,
        td {
            font-family: "Times New Roman", Times, serif;
        }

        th {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2 align="center">DAFTAR NILAI KURANG</h2>
    @if ($tampung == 'n_hadits')
    <h2 align="center">AlQuran Hadits</h2>
    @elseif ($tampung == 'n_aqidah')
    <h2 align="center">Aqidah Akhlaq</h2>
    @elseif ($tampung == 'n_fiqih')
    <h2 align="center">Fiqih</h2>
    @elseif ($tampung == 'n_ski')
    <h2 align="center">Sejarah Kebudayaan Islam</h2>
    @elseif ($tampung == 'n_pkn')
    <h2 align="center">Pendidikan Kewarganegaraan</h2>
    @elseif ($tampung == 'n_bindo')
    <h2 align="center">Bahasa Indonesia</h2>
    @elseif ($tampung == 'n_barab')
    <h2 align="center">Bahasa Arab</h2>
    @elseif ($tampung == 'n_binggris')
    <h2 align="center">Bahasa Inggris</h2>
    @elseif ($tampung == 'n_matematika')
    <h2 align="center">Matematika</h2>
    @elseif ($tampung == 'n_ipa')
    <h2 align="center">Ilmu Pengetahuan Alam</h2>
    @elseif ($tampung == 'n_ips')
    <h2 align="center">Ilmu Pengetahuan Sosial</h2>
    @elseif ($tampung == 'n_sebud')
    <h2 align="center">Seni Budaya</h2>
    @elseif ($tampung == 'n_jasmani')
    <h2 align="center">Pendidikan Jasmani</h2>
    @elseif ($tampung == 'n_prakarya')
    <h2 align="center">Prakarya</h2>
    @elseif ($tampung == 'n_bjawa')
    <h2 align="center">Bahasa Jawa</h2>
    @elseif ($tampung == 'n_tik')
    <h2 align="center">Informatika</h2>
    @endif
    <br>
    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NAMA SISWA</th>
                <th>KELAS</th>
                <th>NILAI</th>
            </tr>
            @foreach ($rapot as $rapot)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th style="text-align:left">{{ $rapot->siswa->nama}}</th>
                <th>{{ $rapot->siswa->kelas->nama_kelas}}</th>
                <th>{{ $rapot->$tampung }}</th>
            </tr>
            @endforeach
        </thead>
</body>

</html>