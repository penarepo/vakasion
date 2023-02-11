<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <style>
        body {
            font-family: 'Arial';
            font-size: 12px;
        }

    </style>
    <title>Cetak Vakasi Ujian</title>
</head>

<body>
    <br>
    <br>
    <br>
    <h4 class="text-center">BUKTI PENGAMBILAN VAKASI SOAL</h4>
    <h4 class="text-center">KOREKSI NILAI DAN INSENTIF</h4>
    @if($jenis_vakasi == "UTS")
        <h4 class="text-center">UJIAN TENGAH SEMESTER</h4>
    @else
        <h4 class="text-center">UJIAN AKHIR SEMESTER</h4>
    @endif

    <br>
    <br>
    <table class="table table-sm table-borderless">
        <tr>
            <td><b>Tanggal</b></td>
            <td>:</td>
            <td>{{ date("d-m-Y") }}</td>
            <td><b>Semester</b></td>
            <td>:</td>
            <td>{{ $tahun_akademik->nama_tahun }}</td>
        </tr>
        <tr>
            <td><b>Nama Dosen</b></td>
            <td>:</td>
            <td>{{ $data_dosen->dosen_pengajar }}</td>
            <td><b>Program</b></td>
            <td>:</td>
            <td>{{ $data_dosen->prodi }}</td>
        </tr>
    </table>

    <table class="table table-striped table-sm mt-4">
        <thead>
            <tr class="table-primary text-center">
                <th rowspan="2">Kode MK</th>
                <th rowspan="2">Nama Mata Kuliah</th>
                <th rowspan="2">Kelas</th>
                <th rowspan="2">Jumlah Mhs</th>
                <th rowspan="2">Status</th>
                <th colspan="2">Honor</th>
                <th rowspan="2" class="text-right">Jumlah Total</th>
            </tr>
            <tr class="table-primary text-center">
                <th>Tepat Mengajar</th>
                <th>Periksa Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @if(count($vakasi) != 0)
                @foreach($vakasi as $item)
                    <tr>
                        <td>{{ $item->kode_mk }}</td>
                        <td>{{ $item->nama_mk }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->jumlah_peserta_kelas }}</td>
                        @if($jenis_vakasi == "UTS")
                            <td>{{ $item->tgl_pengisian_nilai_uts <= $tahun_akademik->tgl_batas_uts ? "Tepat" : "Terlambat" }}
                            </td>
                            <td>Rp
                                {{ number_format($item->insentif_vakasi_uts,0,',','.') }}
                            </td>
                            <td>Rp
                                {{ $item->tgl_pengisian_nilai_uts <= $tahun_akademik->tgl_batas_uts ? number_format($item->jumlah_peserta_kelas * $setting->honor_soal,0,',','.') : number_format($item->jumlah_peserta_kelas * $setting->honor_soal_lewat,0,',','.') }}
                            </td>
                            <td class="text-right">Rp
                                {{ $item->tgl_pengisian_nilai_uts <= $tahun_akademik->tgl_batas_uts ? number_format($item->jumlah_peserta_kelas * $setting->honor_soal + $item->insentif_vakasi_uts,0,',','.') : number_format($item->jumlah_peserta_kelas * $setting->honor_soal_lewat + $item->insentif_vakasi_uts,0,',','.') }}
                            </td>
                        @else
                            <td>{{ $item->tgl_pengisian_nilai_uas <= $tahun_akademik->tgl_batas_uas ? "Tepat" : "Terlambat" }}
                            </td>
                            <td>Rp
                                {{ number_format($item->insentif_vakasi_uas,0,',','.') }}
                            </td>
                            <td>Rp
                                {{ $item->tgl_pengisian_nilai_uas <= $tahun_akademik->tgl_batas_uas ? number_format($item->jumlah_peserta_kelas * $setting->honor_soal,0,',','.') : number_format($item->jumlah_peserta_kelas * $setting->honor_soal_lewat,0,',','.') }}
                            </td>
                            <td class="text-right">Rp
                                {{ $item->tgl_pengisian_nilai_uas <= $tahun_akademik->tgl_batas_uas ? number_format($item->jumlah_peserta_kelas * $setting->honor_soal + $item->insentif_vakasi_uas,0,',','.') : number_format($item->jumlah_peserta_kelas * $setting->honor_soal_lewat + $item->insentif_vakasi_uas,0,',','.') }}
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr class="text-center">
                    <td colspan="7"><b>Total Insetif dan Vakasi</b></td>
                    <td class="text-right"><b>Rp
                            {{ number_format($total,0,',','.') }}</b>
                    </td>
                </tr>
            @else
                <tr class="text-center">
                    <td colspan="8"><b>Belum Upload Nilai</b></td>
                </tr>
            @endif
        </tbody>
    </table>
    <br>
    @if($total != 0)
        <span><b>Honor Pembuatan Soal</b></span>
        <table class="table table-striped table-sm mt-4">
            <thead>
                <tr class="table-primary text-center">
                    <th>Kode MK</th>
                    <th colspan="6">Nama Mata Kuliah</th>
                    <th class="text-right">Jumlah Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalbonus = 0
                @endphp
                @php
                $temp_item = "awal"
                @endphp
                @foreach($vakasi as $item)
                    <tr class="text-center">
                        @if ($temp_item == "awal" || $temp_item != $item->kode_mk)
                            @if($jenis_vakasi == "UTS" && $item->bonus_soal_uts == "T")
                                <td>{{ $item->kode_mk }}</td>
                                <td colspan="6">{{ $item->nama_mk }}</td>
                                <td class="text-right">{{ $setting->honor_pembuat_soal }}</td>
                                @php
                                $totalbonus += $setting->honor_pembuat_soal
                                @endphp
                            @endif
                            @if($jenis_vakasi == "UAS" && $item->bonus_soal_uas == "T")
                                <td>{{ $item->kode_mk }}</td>
                                <td colspan="6">{{ $item->nama_mk }}</td>
                                <td class="text-right">{{ $setting->honor_pembuat_soal }}</td>
                                @php
                                $totalbonus += $setting->honor_pembuat_soal
                                @endphp
                            @endif
                        @else
                            
                        @endif
                    </tr>
                    @php
                    $temp_item = $item->kode_mk
                    @endphp
                @endforeach
                <tr class="text-center">
                    <td></td>
                    <td colspan="6"><b>Total Insentif Pembuatan Soal</b></td>
                    <td class="text-right"><b>Rp {{ number_format($totalbonus,0,',','.') }}</b></td>
                </tr>
                <tr class="text-center">
                    <td colspan="7"><b>Total Keseluruhan</b></td>
                    @php
                        $totalkeseluruhan = $total + $totalbonus
                    @endphp
                    <td class="text-right"><b>Rp {{ number_format($totalkeseluruhan,0,',','.') }}</b></td>
                </tr>
            </tbody>
        </table>
    @endif

    <div style="right: -320; position: relative;">
        <p><b>Diterima Oleh,</b></p>
        <br>
        <br>
        <br>
        <p><b><u>{{ $data_dosen->dosen_pengajar }}</u></b></p>
    </div>
</body>

</html>
