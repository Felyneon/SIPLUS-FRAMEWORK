<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan - SIPLUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 flex-col justify-between hidden md:flex">
        <div>
            <div class="p-6 pb-4">
                <div class="text-[11px] text-gray-400 font-medium tracking-wide mb-1">RUANGAN SIPLUS</div>
                <div class="flex items-center space-x-3 mt-2">
                    <div class="w-9 h-9 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold">
                        S
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-900 leading-tight">SIPLUS</h1>
                        <p class="text-[11px] text-gray-500">Fakultas Vokasi UNAIR</p>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">MENU UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                        Beranda
                    </a>
                    <a href="{{ url('/peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                        Status Peminjaman
                    </a>
                    <a href="{{ route('ruangan.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                        Ruangan
                    </a>
                    <a href="{{ route('ruangan.create') }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg">
                        Tambah Ruangan
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center p-2 bg-blue-50/60 rounded-xl border border-blue-100/50">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                    A
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-xs font-bold text-gray-900 truncate">Admin Sarpras</p>
                    <p class="text-[10px] text-gray-500 truncate">Gedung A, B & C</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col">
        <div class="bg-white px-8 py-3 border-b border-gray-200 text-xs text-gray-500 flex items-center space-x-2">
            <span class="text-blue-600 font-medium">SIPLUS</span>
            <span>›</span>
            <a href="{{ route('ruangan.index') }}" class="hover:text-blue-600">Ruangan</a>
            <span>›</span>
            <span class="text-gray-700 font-medium">Tambah Ruangan</span>
        </div>

        <div class="p-8 max-w-4xl w-full mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Ruangan Baru</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Tambahkan data ruang kelas, lab, atau aula Fakultas Vokasi UNAIR.</p>
                </div>
                <a href="{{ route('ruangan.index') }}" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-xl text-xs font-bold shadow-sm">
                    ← Kembali ke Daftar
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl p-4 text-xs">
                    <p class="font-bold mb-1">Periksa kembali isian form:</p>
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ruangan.store') }}" method="POST" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Kode Ruang <span class="text-rose-500">*</span></label>
                        <input type="text" name="kode_ruang" value="{{ old('kode_ruang') }}" placeholder="Contoh: GA-201" required
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Ruangan <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan') }}" placeholder="Contoh: Ruang Teori Kuliah GA-201" required
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Kapasitas (Orang) <span class="text-rose-500">*</span></label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" min="1" max="5000" placeholder="Contoh: 45" required
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Lokasi Gedung <span class="text-rose-500">*</span></label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Gedung A Lt. 2" required
                            class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Status Ruangan <span class="text-rose-500">*</span></label>
                    <select name="status" required
                        class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">
                        @foreach (\App\Models\Ruangan::STATUS as $key => $label)
                            <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                {{ is_string($label) ? $label : $key }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi / Fasilitas</label>
                    <textarea name="deskripsi" rows="3" placeholder="Contoh: AC, Proyektor HDMI, Papan Tulis, Sound System"
                        class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-lg text-xs text-gray-800 focus:outline-none focus:border-blue-500">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-2 border-t border-gray-100">
                    <a href="{{ route('ruangan.index') }}" class="px-5 py-2.5 border border-gray-200 rounded-xl text-xs font-bold text-gray-600 bg-white hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-sm">
                        Simpan Ruangan
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>