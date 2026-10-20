<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SIPLUS</title>
</head>
<body>
    {{-- Auth::user()->name otomatis mengambil nama user yang sedang login --}}
    <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p>Ini adalah halaman utama sistem informasi peminjaman ruangan Fakultas Vokasi.</p>

    <ul>
        <li><a href="/ruangan">Kelola / Lihat Daftar Ruangan</a></li>
    </ul>

    <br>
    {{-- Tombol Logout --}}
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" style="background: red; color: white;">Logout</button>
    </form>
</body>
</html>