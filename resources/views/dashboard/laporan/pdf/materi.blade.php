<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Materi</title>
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
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: bold; }
        .badge-success { background-color: #28a745; color: #fff; }
        .badge-secondary { background-color: #6c757d; color: #fff; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        @if ($logoBase64)
            <img src="data:image/png;base64,{{ $logoBase64 }}" alt="SIPINTER">
        @endif
        <h1>Laporan Data Materi</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">No</th>
                <th>Judul</th>
                <th>Guru</th>
                <th>Jenjang</th>
                <th>Kategori</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materiList as $materi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $materi->judul }}</td>
                    <td>{{ $materi->guru->name ?? '-' }}</td>
                    <td>{{ $materi->jenjang->nama_jenjang ?? '-' }}</td>
                    <td>{{ $materi->kategori->nama_kategori ?? '-' }}</td>
                    <td>
                        @if ($materi->is_published)
                            <span class="badge badge-success">Published</span>
                        @else
                            <span class="badge badge-secondary">Draft</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data materi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        SIPINTER - Sistem Informasi Pembelajaran Interaktif &mdash; Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
    </div>
</body>
</html>
