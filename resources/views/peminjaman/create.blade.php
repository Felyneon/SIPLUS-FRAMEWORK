<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ajukan Peminjaman Ruangan - SIPLUS</title>
</head>
<body>
    <h1>Form Peminjaman Ruangan Fakultas Vokasi</h1>

    @if($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/peminjaman" method="POST">
        @csrf
        <div>
            <label>Pilih Ruangan:</label><br>
            <select name="ruangan_id" required>
                <option value="">-- Pilih Ruangan Vokasi --</option>
                @foreach($ruangans as $r)
                    <option value="{{ $r->id }}">{{ $r->nama_ruangan }} (Kapasitas: {{ $r->kapasitas }} orang)</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label>Tanggal & Jam Mulai:</label><br>
            <input type="datetime-local" name="tanggal_mulai" required>
        </div>
        <br>
        <div>
            <label>Tanggal & Jam Selesai:</label><br>
            <input type="datetime-local" name="tanggal_selesai" required>
        </div>
        <br>
        <div>
            <label>Keperluan Peminjaman:</label><br>
            <textarea name="keperluan" rows="4" required></textarea>
        </div>
        <br>
        <button type="submit">Ajukan Peminjaman</button>
    </form>

    <br>
    <a href="/dashboard">Kembali ke Dashboard</a>
</body>
</html>