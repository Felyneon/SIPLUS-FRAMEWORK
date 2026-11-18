<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPLUS Vokasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2" x-data="{ kategori: 'mahasiswa' }">
        
        <!-- SISI KIRI: Banner & Informasi Vokasi UNAIR -->
        <div class="relative hidden md:flex flex-col justify-between p-10 text-white bg-blue-900 bg-cover bg-center" style="background-image: linear-gradient(to bottom, rgba(11, 46, 89, 0.9), rgba(15, 23, 42, 0.95));">
            <div>
                <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl w-fit mb-6 border border-white/10">
                    <span class="text-xl">🏛️</span>
                    <div>
                        <h4 class="text-[10px] font-semibold tracking-wider uppercase text-blue-200">Universitas Airlangga</h4>
                        <p class="text-xs font-bold">Fakultas Vokasi UNAIR</p>
                    </div>
                </div>
                <span class="inline-block bg-emerald-500/20 text-emerald-300 text-xs px-3 py-1 rounded-full border border-emerald-500/30 mb-6">
                    ● Kampus B Dharmawangsa Surabaya
                </span>
            </div>

            <div>
                <h1 class="text-3xl font-extrabold tracking-tight mb-3">SIPLUS VOKASI</h1>
                <p class="text-sm text-blue-100 leading-relaxed mb-8">
                    Sistem Informasi Manajemen Peminjaman Ruangan & Fasilitas Terpadu Vokasi UNAIR.
                </p>
                
                <div class="space-y-2">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-blue-300">KLASTER FASILITAS</p>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="bg-white/10 backdrop-blur-sm p-2.5 rounded-xl border border-white/10 text-center">
                            <span class="block text-xs font-bold">GD-A</span>
                            <span class="text-[10px] text-blue-200">Gedung A</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-2.5 rounded-xl border border-white/10 text-center">
                            <span class="block text-xs font-bold">GD-B</span>
                            <span class="text-[10px] text-blue-200">Gedung B</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm p-2.5 rounded-xl border border-white/10 text-center">
                            <span class="block text-xs font-bold">GD-C</span>
                            <span class="text-[10px] text-blue-200">Gedung C</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-xs text-blue-200 border-t border-white/10 pt-4 mt-6">
                <p class="font-semibold">🕒 Layanan Pengelola Ruang Kampus B</p>
                <p class="text-[11px] opacity-80">Senin - Jumat: 07.00 - 20.30 WIB | Sabtu: 08.00 - 15.00 WIB</p>
            </div>
        </div>

        <!-- SISI KANAN: Form Login Interaktif -->
        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <span class="text-xs font-bold tracking-wider text-gray-400 uppercase">LOGIN SIPLUS</span>
                <div class="flex bg-gray-100 p-1 rounded-xl">
                    <span class="px-4 py-1.5 text-xs font-semibold bg-white rounded-lg shadow-sm text-blue-900">Login</span>
                    <a href="{{ route('register') }}" class="px-4 py-1.5 text-xs font-semibold text-gray-500 hover:text-gray-900 transition">Registrasi</a>
                </div>
            </div>

            <!-- Tombol Pilihan Mahasiswa / Pengelola -->
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 mb-2">KATEGORI CIVITAS AKADEMIKA</label>
                <div class="grid grid-cols-2 gap-2 bg-gray-100 p-1.5 rounded-xl">
                    <button type="button" 
                        @click="kategori = 'mahasiswa'" 
                        :class="kategori === 'mahasiswa' ? 'bg-white shadow-sm text-blue-900' : 'text-gray-500 hover:text-gray-900'"
                        class="py-2 text-xs font-semibold rounded-lg text-center transition">
                        Mahasiswa
                    </button>
                    <button type="button" 
                        @click="kategori = 'pengelola'" 
                        :class="kategori === 'pengelola' ? 'bg-white shadow-sm text-blue-900' : 'text-gray-500 hover:text-gray-900'"
                        class="py-2 text-xs font-semibold rounded-lg text-center transition">
                        Pengelola
                    </button>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="role" x-model="kategori">

                <!-- Input Dinamis NIM / NIP -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1" x-text="kategori === 'mahasiswa' ? 'Nomor Induk Mahasiswa (NIM)' : 'Nomor Induk Pegawai (NIP)'"></label>
                    <input type="text" :name="kategori === 'mahasiswa' ? 'nim' : 'nip'" :placeholder="kategori === 'mahasiswa' ? 'Contoh: 152111513000' : 'Contoh: 198501012020121001'" class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email Vokasi</label>
                    <input type="email" name="email" placeholder="nama.mahasiswa@vokasi.unair.ac.id" class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50" required>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-semibold text-gray-600">Kata Sandi</label>
                        <a href="#" class="text-xs text-blue-600 hover:underline">Lupa sandi?</a>
                    </div>
                    <input type="password" name="password" placeholder="••••••••••••" class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50" required>
                </div>

                <button type="submit" class="w-full bg-[#0B2E59] hover:bg-blue-900 text-white font-semibold py-3.5 px-4 rounded-xl transition duration-200 text-sm shadow-lg shadow-blue-900/20 flex items-center justify-center space-x-2">
                    <span>Masuk ke SIM-RUANG</span>
                    <span>→</span>
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-xs text-gray-500">Mengalami kendala akun? <a href="#" class="text-blue-700 font-semibold hover:underline">Hubungi Helpdesk Vokasi</a></p>
            </div>
        </div>

    </div>
</body>
</html>