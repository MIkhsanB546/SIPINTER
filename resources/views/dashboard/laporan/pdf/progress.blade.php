<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Progress Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #095890; padding-bottom: 15px; }
        .header img { height: 50px; width: auto; }
        .header h1 { margin: 10px 0 5px; font-size: 20px; color: #095890; text-transform: uppercase; }
        .header p { margin: 0; font-size: 11px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #095890; color: #fff; padding: 8px 10px; text-align: left; font-size: 11px; }
        td { padding: 6px 10px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) { background-color: #f5f9fc; }
        .text-center { text-align: center; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        @if ($logoBase64)
            <img src="data:image/png;base64,{{ $logoBase64 }}" alt="SIPINTER">
        @endif
        <h1>Laporan Progress Siswa</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">No</th>
                <th>Nama</th>
                <th>Quiz Dikerjakan</th>
                <th>Rata-rata Nilai</th>
                <th>Nilai Tertinggi</th>
                <th>Nilai Terendah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswaProgress as $siswa)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td class="text-center">{{ $siswa->quiz_dikerjakan ?? 0 }}</td>
                    <td class="text-center">{{ $siswa->rata_rata_nilai ?? 0 }}</td>
                    <td class="text-center">{{ $siswa->nilai_tertinggi ?? 0 }}</td>
                    <td class="text-center">{{ $siswa->nilai_terendah ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data siswa</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        SIPINTER - Sistem Informasi Pembelajaran Interaktif &mdash; Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
    </div>
</body>
</html>
