<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan SIPLUS</title>
</head>
<body>
    <h1>Daftar Ruangan Fakultas Vokasi</h1>
    
    <ul>
        @foreach ($ruangans as $r)
            <li>
                <strong>{{ $r->nama_ruangan }}</strong> - 
                Kapasitas: {{ $r->kapasitas }} orang 
                (Lokasi: {{ $r->lokasi }})
            </li>
        @endforeach
    </ul>
</body>
</html>