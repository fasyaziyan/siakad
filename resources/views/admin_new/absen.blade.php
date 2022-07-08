<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td {
            text-align: center;
        }
        td.kiri {
            text-align: left;
        }
    </style>
</head>

<body>
    <p align="center"><b> ABSENSI KEHADIRAN SISWA KELAS {{$kelas->tingkat->nama_tingkat }} - {{ $kelas->nama_kelas }}
    </p>
    <p align="center"><b> MTS AL FAJAR KANDAT</p>
    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr style="background-color: #C1C1B7">
                @for ($i = 1; $i <= 38; $i++)
                   @if ($i == 1)
                   <th colspan="2">NOMOR</th>
                   @elseif ($i == 2)
                    <th rowspan="2">Nama Siswa</th>
                   @elseif ($i == 3)
                   <th rowspan="2">L/P</th>
                   @elseif ($i == 5)
                   <th colspan="31">Bulan {{ $bulan }}</th>
                   @elseif ($i == 36)
                     <th colspan="3" rowspan="2">Absensi</th>
                     @endif
                @endfor
            </tr>
            <tr style="background-color: #C1C1B7">
                @for ($i = 1; $i <= 38; $i++)
                @if ($i == 1)
                <th>NO</th>
                @elseif ($i == 2)
                <th>NISN</th>
                @elseif ($i == 30)
                <th colspan="31">Tanggal</th>
                @endif
                @endfor
            </tr>
            <tr>
                @for ($i = 1; $i <= 4; $i++)
                <th> </th>
                @endfor
                @for ($i = 1; $i <= 31; $i++)
                <th>{{ $i }}</th>
                @endfor
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
            @foreach ($siswa as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nisn }}</td>
                <td class="kiri">{{ $data->nama }}</td>
                <td>@if ( $data->jenis_kelamin == 'Laki-laki') L @else P @endif</td>
                @for ($i = 1; $i <= 34; $i++)
                <td width="15px"> </td>
                @endfor
            </tr>
            @endforeach
        </thead>
    </table>
</body>

</html>
