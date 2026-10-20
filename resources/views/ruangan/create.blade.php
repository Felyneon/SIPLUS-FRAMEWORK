<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ruangan SIPLUS</title>
</head>
<body>
    <h1>Tambah Ruangan Vokasi Baru</h1>

    {{-- Form wajib menggunakan @csrf untuk keamanan di Laravel --}}
    <form action="/ruangan" method="POST">
        @csrf
        <div>
            <label>Nama Ruangan:</label><br>
            <input type="text" name="nama_ruangan" required>
        </div>
        <br>
        <div>
            <label>Kapasitas (Orang):</label><br>
            <input type="number" name="kapasitas" required>
        </div>
        <br>
        <div>
            <label>Lokasi Gedung:</label><br>
            <input type="text" name="lokasi" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="deskripsi"></textarea>
        </div>
        <br>
        <button type="submit">Simpan Ruangan</button>
    </form>
    
    <br>
    <a href="/ruangan">Kembali ke Daftar Ruangan</a>
</body>
</html>