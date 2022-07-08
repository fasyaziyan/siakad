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
            font-size: 12px;
        }

        th {
            font-weight: bold;
            font-size: 12px;
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
                        <th align="left">No Induk </th>
            <th>:</th>
            <th align="left">{{ $rapot->siswa->nisn}}</th>
        </tr>
        <tr>
            <th align="left">Nama </th>
            <th>:</th>
            <th>{{ $rapot->siswa->nama}}</th>
        </tr>
        <tr>
            <th align="left">Kelas </th>
            <th>:</th>
            <th align="left">{{ $rapot->siswa->kelas->nama_kelas}}</th>
        </tr>
    </table>
    </th>
    <th>
        <table>
            <tr>
                <th align="left">Semester </th>
                <th>:</th>
                <th align="left">{{ $rapot->kurikulum->semester}}</th>
            </tr>
            <tr>
                <th align="left">Tahun Pelajaran </th>
                <th>:</th>
                <th>{{ $rapot->kurikulum->tahun_ajaran}}</th>
            </tr>
            <tr>
                <th align="left"></th>
                <th></th>
                <th></th>
            </tr>
        </table>
    </th>
    </tr>
    </table>

    <br>
    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>MATA PELAJARAN</th>
                <th>KKM</th>
                <th>NILAI</th>
                <th>KETERANGAN PENCAPAIAN</th>
                <th>PREDIKAT</th>
            </tr>
            <tr>
                <td align="center" style="font-weight: bold; font-size : 12px;">A</td>
                <td style="text-align: left; font-weight: bold; font-size : 12px;">MATA PELAJARAN</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="5" align="center">1</td>
                <td style="text-align: left;">Pendidikan Agama</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>a. AlQuran Hadits</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_hadits}}</td>
                @if ($rapot->n_hadits >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_hadits >= 90 and $rapot->n_hadits <= 100) <td align="center">A</td>
                    @elseif($rapot->n_hadits >= 75) <td align="center">B</td>
                    @elseif($rapot->n_hadits >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td>b. Aqidah Akhlaq</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_aqidah}}</td>
                @if ($rapot->n_aqidah >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_aqidah >= 90 and $rapot->n_aqidah <= 100) <td align="center">A</td>
                    @elseif($rapot->n_aqidah >= 75) <td align="center">B</td>
                    @elseif($rapot->n_aqidah >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td>c. Fiqih</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_fiqih}}</td>
                @if ($rapot->n_fiqih >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_fiqih >= 90 and $rapot->n_fiqih <= 100) <td align="center">A</td>
                    @elseif($rapot->n_fiqih >= 75) <td align="center">B</td>
                    @elseif($rapot->n_fiqih >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td>d. Sejarah Kebudayaan Islam (SKI)</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_ski}}</td>
                @if ($rapot->n_ski >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_ski >= 90 and $rapot->n_ski <= 100) <td align="center">A</td>
                    @elseif($rapot->n_ski >= 75) <td align="center">B</td>
                    @elseif($rapot->n_ski >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">2</td>
                <td>Pendidikan Kewarganegaraan</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_pkn}}</td>
                @if ($rapot->n_pkn >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_pkn >= 90 and $rapot->n_pkn <= 100) <td align="center">A</td>
                    @elseif($rapot->n_pkn >= 75) <td align="center">B</td>
                    @elseif($rapot->n_pkn >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">3</td>
                <td>Bahasa Indonesia</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_bindo}}</td>
                @if ($rapot->n_bindo >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_bindo >= 90 and $rapot->n_bindo <= 100) <td align="center">A</td>
                    @elseif($rapot->n_bindo >= 75) <td align="center">B</td>
                    @elseif($rapot->n_bindo >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">4</td>
                <td>Bahasa Arab</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_barab}}</td>
                @if ($rapot->n_barab >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_barab >= 90 and $rapot->n_barab <= 100) <td align="center">A</td>
                    @elseif($rapot->n_barab >= 75) <td align="center">B</td>
                    @elseif($rapot->n_barab >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">5</td>
                <td>Bahasa Inggris</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_binggris}}</td>
                @if ($rapot->n_binggris >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_binggris >= 90 and $rapot->n_binggris <= 100) <td align="center">A</td>
                    @elseif($rapot->n_binggris >= 75) <td align="center">B</td>
                    @elseif($rapot->n_binggris >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">6</td>
                <td>Matematika</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_matematika}}</td>
                @if ($rapot->n_matematika >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_matematika >= 90 and $rapot->n_matematika <= 100) <td align="center">A</td>
                    @elseif($rapot->n_matematika >= 75) <td align="center">B</td>
                    @elseif($rapot->n_matematika >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">7</td>
                <td>Ilmu Pengetahuan Alam</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_ipa}}</td>
                @if ($rapot->n_ipa >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_ipa >= 90 and $rapot->n_ipa <= 100) <td align="center">A</td>
                    @elseif($rapot->n_ipa >= 75) <td align="center">B</td>
                    @elseif($rapot->n_ipa >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">8</td>
                <td>Ilmu Pengetahuan Sosial</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_ips}}</td>
                @if ($rapot->n_ips >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_ips >= 90 and $rapot->n_ips <= 100) <td align="center">A</td>
                    @elseif($rapot->n_ips >= 75) <td align="center">B</td>
                    @elseif($rapot->n_ips >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">9</td>
                <td>Seni Budaya</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_sebud}}</td>
                @if ($rapot->n_sebud >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_sebud >= 90 and $rapot->n_sebud <= 100) <td align="center">A</td>
                    @elseif($rapot->n_sebud >= 75) <td align="center">B</td>
                    @elseif($rapot->n_sebud >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td align="center">10</td>
                <td>Pendidikan Jasmani</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_jasmani}}</td>
                @if ($rapot->n_jasmani >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_jasmani >= 90 and $rapot->n_jasmani <= 100) <td align="center">A</td>
                    @elseif($rapot->n_jasmani >= 75) <td align="center">B</td>
                    @elseif($rapot->n_jasmani >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                @if ($rapot->siswa->kelas->nama_kelas == '1 A' or $rapot->siswa->kelas->nama_kelas == '1 B' )
                <td align="center">11</td>
                <td>Prakarya</td>
                <td align="center">{{ $kkm }}</td>>
                <td align="center">{{ $rapot->n_prakarya}}</td>
                @if ($rapot->n_prakarya >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_prakarya >= 90 and $rapot->n_prakarya <= 100) <td align="center">A</td>
                    @elseif($rapot->n_prakarya >= 75) <td align="center">B</td>
                    @elseif($rapot->n_prakarya >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
                @elseif ($rapot->siswa->kelas->nama_kelas == '2 A' or $rapot->siswa->kelas->nama_kelas == '2 B')
                <td align="center">11</td>
                <td>Informatika</td>
                <td align="center">{{ $kkm }}</td>>
                <td align="center">{{ $rapot->n_tik}}</td>
                @if ($rapot->n_tik >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_tik >= 90 and $rapot->n_tik <= 100) <td align="center">A</td>
                    @elseif($rapot->n_tik >= 75) <td align="center">B</td>
                    @elseif($rapot->n_tik >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
                @else
                <td><br></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                @endif
            </tr>
            <tr>
                <td align="center" style="font-weight: bold;">B</td>
                <td style="font-weight: bold;">MUATAN LOKAL</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>1. Bahasa Jawa</td>
                <td align="center">{{ $kkm }}</td>
                <td align="center">{{ $rapot->n_bjawa}}</td>
                @if ($rapot->n_bjawa >= $kkm)
                <td align="center">TUNTAS</td>
                @else
                <td align="center">TIDAK TUNTAS</td>
                @endif
                @if ($rapot->n_bjawa >= 90 and $rapot->n_bjawa <= 100) <td align="center">A</td>
                    @elseif($rapot->n_bjawa >= 75) <td align="center">B</td>
                    @elseif($rapot->n_bjawa >= 70) <td align="center">C</td>
                    @else
                    <td align="center">D</td>
                    @endif
            </tr>
            <tr>
                <td></td>
                <td>2.</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>3.</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" colspan="3" style="font-weight: bold;">JUMLAH</td>
                <td align="center">{{ $rapot->jumlah}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" colspan="3" style="font-weight: bold;">RATA-RATA</td>
                <td align="center">{{ $rapot->rata_rata}}</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
    </table>
    <p style="font-size : 12px;"><b>Catatan Wali Kelas</b></p>
    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <td rowspan="3">{{ $rapot->keterangan}}</td>
            </tr>
            <tr></tr>
            <tr></tr>
        </thead>
    </table>
    <br><br><br><br><br><br><br><br>

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
        {{-- <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr> --}}
        <tr>
            <td width="300px"><b> __________________ </b></td>
            <td width="200px"> <b style="text-transform: uppercase;"> <u>  {{ $rapot->siswa->kelas->guru->nama_guru}}</u></b></td>
            <td><b> <u>INDAH INDIASTUTIK, S.Si</u> </b></td>
        </tr>
    </table>
</body>

</html>
