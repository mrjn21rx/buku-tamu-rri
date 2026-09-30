<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan RRI Bukittinggi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #777; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Rekapitulasi Kunjungan Tamu</h2>
        <p>Lembaga Penyiaran Publik RRI Bukittinggi</p>
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">Tanggal</th>
                <th width="12%">Kode</th>
                <th width="15%">Nama Pengunjung</th>
                <th width="20%">Instansi/Alamat</th>
                <th width="10%">Divisi Tujuan</th>
                <th width="20%">Keperluan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $index => $v)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($v->tanggal_kunjungan)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $v->kode_registrasi }}</td>
                <td>{{ $v->nama_lengkap }}<br><small>{{ $v->no_hp }}</small></td>
                <td>{{ $v->alamat }}</td>
                <td class="text-center">{{ $v->divisi_tujuan }}</td>
                <td>{{ Str::limit($v->keperluan, 40) }}</td>
                <td class="text-center">{{ $v->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>