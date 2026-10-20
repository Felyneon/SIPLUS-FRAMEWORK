<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIPLUS Vokasi</title>
</head>
<body>
    <h2>Login Sistem Peminjaman Ruangan (SIPLUS)</h2>

    {{-- Menampilkan pesan error jika login gagal --}}
    @if($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <br>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>