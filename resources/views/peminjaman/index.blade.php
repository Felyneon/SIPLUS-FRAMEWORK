<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman - SIPLUS</title>
</head>
<body>
    <h1>Riwayat Peminjaman Ruangan Anda</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><a href="/peminjaman/tambah">+ Ajukan Peminjaman Baru</a> | <a href="/dashboard">Kembali ke Dashboard</a></p>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Keperluan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->ruangan->nama_ruangan ?? 'Ruangan Tidak Ditemukan' }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>{{ $p->keperluan }}</td>
                    <td><strong>{{ $p->status }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada riwayat peminjaman ruangan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>