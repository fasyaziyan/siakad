<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}"> --}}
    <title>Document</title>
    <style>
        p,
        td {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
        }

        td.tengah {
            text-align: center;
        }

        td.tebal {
            font-weight: bold;
        }

        th {
            font-weight: bold;
            font-size: 15px;
        }

        h4 {
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <p align="center"><b> KEMENTRIAN AGAMA
            <br>
            YAYASAN PENDIDIKAN ISLAM AL FAJAR
            <br>
            MTS AL FAJAR KANDAT
            <br>
            <b>
    </p>
    <p align="center"><b> Raya No. 252 B Kandat Kediri Telp. (0354) 411318 <b></p>
    <hr style="border: 1px solid #000;">
    <p align="center" style="font-weight: bold;">LAPORAN HASIL BELAJAR PESERTA DIDIK</p>
    <table>
        <tr>
            <th width="400px">
                <table>
                    <tr>
                        <td align="left">No Induk </td>
                        <td>:</td>
                        <td align="left">{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <td align="left">Nama </td>
                        <td>:</td>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td align="left">Kelas </td>
                        <td>:</td>
                        <td align="left">{{ $siswa->kelas->tingkat->nama_tingkat }} -
                            {{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                </table>
            </th>
            <th>
                <table>
                    <tr>
                        <td align="left">Semester </td>
                        <td>:</td>
                        <td align="left">{{ $siswa->kelas->kurikulum->semester }}</td>
                    </tr>
                    <tr>
                        <td align="left">Tahun Pelajaran </td>
                        <td>:</td>
                        <td>{{ $siswa->kelas->kurikulum->tahun_ajaran }}</td>
                    </tr>
                    <tr>
                        <td align="left"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </th>
        </tr>
    </table>

    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr style="background-color: #DDE73D;">
                <td class="tengah tebal">NO</td>
                <td class="tengah tebal">MATA PELAJARAN</td>
                <td class="tengah tebal">KKM</td>
                <td class="tengah tebal">NILAI</td>
                <td class="tengah tebal">KETERANGAN PENCAPAIAN</td>
                <td class="tengah tebal">PREDIKAT</td>
            </tr>
            <tr style="background-color: #E1E77F;">
                <td align="center" style="font-weight: bold;">A</td>
                <td style="text-align: left; font-weight: bold;">MATA PELAJARAN</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="5" align="center">{{ $no++ }}</td>
                <td style="text-align: left; font-weight: bold; font-size : 12px;">Pendidikan Agama</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach($nilai as $data)
            @if($loop->iteration >=1 && $loop->iteration <=4) <tr>
                <td style="text-align: left; font-weight: bold; font-size : 12px;">{{ $data->nama_mapel}}</td>
                <td class="tengah">{{ $kkm }}</td>
                <td class="tengah">{{ $data->nilai }}</td>
                @if ( $data->nilai < $kkm ) <td class="tengah">TIDAK TUNTAS</td>
                    @else
                    <td class="tengah">TUNTAS</td>
                    @endif
                    @if ($data->nilai >= 90 and $data->nilai <= 100) <td align="center">A</td>
                        @elseif($data->nilai >= 75)
                        <td align="center">B</td>
                        @elseif($data->nilai >= 70)
                        <td align="center">C</td>
                        @else
                        <td align="center">D</td>
                        @endif
                        </tr>
                        @elseif($loop->iteration == 15)
                        <tr style="background-color: #E1E77F;">
                            <td align="center" style="font-weight: bold;">B</td>
                            <td style="text-align: left; font-weight: bold;">MUATAN LOKAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center" style="font-weight: bold; font-size : 12px;">{{ $no++ }}</td>
                            <td style="text-align: left; font-weight: bold; font-size : 12px;">
                                {{ $data->nama_mapel}}</td>
                            <td class="tengah">{{ $kkm }}</td>
                            <td class="tengah">{{ $data->nilai }}</td>
                            @if ( $data->nilai < $kkm ) <td class="tengah">TIDAK TUNTAS</td>
                                @else
                                <td class="tengah">TUNTAS</td>
                                @endif
                                @if ($data->nilai >= 90 and $data->nilai <= 100) <td align="center">A</td>
                                    @elseif($data->nilai >= 75)
                                    <td align="center">B</td>
                                    @elseif($data->nilai >= 70)
                                    <td align="center">C</td>
                                    @else
                                    <td align="center">D</td>
                                    @endif
                        </tr>
                        @else
                        <tr>
                            <td align="center" style="font-weight: bold; font-size : 12px;">{{ $no++ }}</td>
                            <td style="text-align: left; font-weight: bold; font-size : 12px;">
                                {{ $data->nama_mapel}}</td>
                            <td class="tengah">{{ $kkm }}</td>
                            <td class="tengah">{{ $data->nilai }}</td>
                            @if ( $data->nilai < $kkm ) <td class="tengah">TIDAK TUNTAS</td>
                                @else
                                <td class="tengah">TUNTAS</td>
                                @endif
                                @if ($data->nilai >= 90 and $data->nilai <= 100) <td align="center">A</td>
                                    @elseif($data->nilai >= 75)
                                    <td align="center">B</td>
                                    @elseif($data->nilai >= 70)
                                    <td align="center">C</td>
                                    @else
                                    <td align="center">D</td>
                                    @endif
                        </tr>
                        @endif
                        @endforeach
                        <tr>
                            <td align="center" colspan="3" style="font-weight: bold;">JUMLAH</td>
                            <td align="center">{{ $total }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3" style="font-weight: bold;">RATA-RATA</td>
                            <td align="center">{{ $rata_rata}}</td>
                            <td></td>
                            <td></td>
                        </tr>
        </thead>
    </table>
    <br>
    <table>
        <tr>
            <td width="400px">
                <h4>KETIDAK HADIRAN</h4>
            </td>
            <td>
                <h4>CATATAN WALI KELAS</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="border: 1px solid black;">
                    <tr>
                        <td class="tebal" width="150px">Sakit</td>
                        <td class="tebal" width="25px">:</td>
                        <td class="tebal tengah" width="25px">{{ $data->sakit }}</td>
                    </tr>
                    <tr>
                        <td class="tebal">Izin</td>
                        <td class="tebal">:</td>
                        <td class="tebal tengah">{{ $data->izin }}</td>
                    </tr>
                    <tr>
                        <td class="tebal">Tanpa Keterangan</td>
                        <td class="tebal">:</td>
                        <td class="tebal tengah">{{ $data->alpa }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="border: 1px solid black;">
                    <tr>
                        <td width="200px" height="40px">{{ $data->keterangan }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td width="300px"><b> Orang Tua/Wali Siswa, </b></td>
            <td width="200px"> <b> Wali Kelas, </b></td>
            <td><b> Kepala Sekolah, </b></td>
        </tr>
        <tr>
            <td height="70px"> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td width="300px"><b> __________________ </b></td>
            <td width="200px"> <b style="text-transform: uppercase;"> <u> {{$siswa->kelas->guru->nama_guru }}</u></b>
            </td>
            <td><b> <u>INDAH INDIASTUTIK, S.Si</u> </b></td>
        </tr>
    </table>
</body>

</html>
