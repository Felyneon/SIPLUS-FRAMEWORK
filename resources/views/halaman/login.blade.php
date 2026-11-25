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
    <div
        class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 relative"
        x-data="{
            kategori: '{{ old('role', 'mahasiswa') }}',
            modalLupaSandi: false,
            modalBantuan: false,
            resetTerkirim: false,
            emailReset: ''
        }"
        @keydown.escape.window="modalLupaSandi = false; modalBantuan = false"
    >
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
                        class="py-2 text-xs font-semibold rounded-lg text-center transition cursor-pointer">
                        Mahasiswa
                    </button>
                    <button type="button"
                        @click="kategori = 'pengelola'"
                        :class="kategori === 'pengelola' ? 'bg-white shadow-sm text-blue-900' : 'text-gray-500 hover:text-gray-900'"
                        class="py-2 text-xs font-semibold rounded-lg text-center transition cursor-pointer">
                        Pengelola
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl px-4 py-3 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="role" x-model="kategori">

                <!-- Input Dinamis NIM / NIP -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1" x-text="kategori === 'mahasiswa' ? 'Nomor Induk Mahasiswa (NIM)' : 'Nomor Induk Pegawai (NIP)'"></label>
                    <input
                        type="text"
                        :name="kategori === 'mahasiswa' ? 'nim' : 'nip'"
                        :value="kategori === 'mahasiswa' ? '{{ old('nim') }}' : '{{ old('nip') }}'"
                        :placeholder="kategori === 'mahasiswa' ? 'Contoh: 152111513000' : 'Contoh: 198501012020121001'"
                        class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50"
                        required
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email Vokasi</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama.mahasiswa@vokasi.unair.ac.id"
                        class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50"
                        required
                    >
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-semibold text-gray-600">Kata Sandi</label>
                        <button
                            type="button"
                            @click="resetTerkirim = false; modalLupaSandi = true"
                            class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline cursor-pointer"
                        >
                            Lupa sandi?
                        </button>
                    </div>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••••••"
                        class="w-full text-sm px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900 bg-gray-50/50"
                        required
                    >
                </div>

                <button type="submit" class="w-full bg-[#0B2E59] hover:bg-blue-900 text-white font-semibold py-3.5 px-4 rounded-xl transition duration-200 text-sm shadow-lg shadow-blue-900/20 flex items-center justify-center space-x-2 cursor-pointer">
                    <span>Masuk ke SIM-RUANG</span>
                    <span>→</span>
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-xs text-gray-500">
                    Mengalami kendala akun?
                    <button
                        type="button"
                        @click="modalBantuan = true"
                        class="text-blue-700 font-semibold hover:underline cursor-pointer"
                    >
                        Hubungi Helpdesk Vokasi
                    </button>
                </p>
            </div>
        </div>

        <!-- MODAL 1: LUPA SANDI -->
        <div
            x-show="modalLupaSandi"
            x-transition.opacity
            style="display: none;"
            class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4"
        >
            <div
                @click.outside="modalLupaSandi = false"
                class="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-md p-6 space-y-4"
            >
                <div class="flex items-start justify-between gap-3 border-b border-gray-100 pb-3">
                    <div>
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full mb-1">
                            Pemulihan Akun
                        </span>
                        <h3 class="text-base font-bold text-gray-900">Lupa Kata Sandi</h3>
                    </div>
                    <button
                        type="button"
                        @click="modalLupaSandi = false"
                        class="text-gray-400 hover:text-gray-600 text-lg leading-none px-1 cursor-pointer"
                    >
                        ×
                    </button>
                </div>

                <p class="text-xs text-gray-600 leading-relaxed">
                    Masukkan email terdaftar untuk meminta informasi reset kata sandi, atau hubungi pengelola sarpras jika akun belum teraktivasi.
                </p>

                <template x-if="!resetTerkirim">
                    <form @submit.prevent="resetTerkirim = true" class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Email Terdaftar</label>
                            <input
                                type="email"
                                x-model="emailReset"
                                required
                                placeholder="nama@vokasi.unair.ac.id"
                                class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-900"
                            >
                        </div>
                        <div class="flex justify-end gap-2 pt-2">
                            <button
                                type="button"
                                @click="modalLupaSandi = false"
                                class="px-4 py-2 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition cursor-pointer"
                            >
                                Tutup
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 text-xs font-semibold text-white bg-[#0B2E59] hover:bg-blue-900 rounded-xl transition cursor-pointer"
                            >
                                Kirim Permintaan
                            </button>
                        </div>
                    </form>
                </template>

                <template x-if="resetTerkirim">
                    <div class="space-y-3">
                        <div class="bg-blue-50 border border-blue-100 text-blue-900 rounded-xl p-3.5 text-xs leading-relaxed">
                            Permintaan untuk <span class="font-bold" x-text="emailReset"></span> telah dicatat di tampilan lokal. Jika reset password otomatis belum aktif di server, silakan hubungi Helpdesk Sarpras Fakultas Vokasi UNAIR dengan menyertakan NIM/NIP dan email.
                        </div>
                        <div class="flex justify-end">
                            <button
                                type="button"
                                @click="modalLupaSandi = false"
                                class="px-4 py-2 text-xs font-semibold text-white bg-[#0B2E59] hover:bg-blue-900 rounded-xl transition cursor-pointer"
                            >
                                Selesai
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- MODAL 2: BANTUAN / HELPDESK VOKASI -->
        <div
            x-show="modalBantuan"
            x-transition.opacity
            style="display: none;"
            class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4"
        >
            <div
                @click.outside="modalBantuan = false"
                class="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-md p-6 space-y-4"
            >
                <div class="flex items-start justify-between gap-3 border-b border-gray-100 pb-3">
                    <div>
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full mb-1">
                            Pusat Bantuan SIPLUS
                        </span>
                        <h3 class="text-base font-bold text-gray-900">Helpdesk Vokasi UNAIR</h3>
                    </div>
                    <button
                        type="button"
                        @click="modalBantuan = false"
                        class="text-gray-400 hover:text-gray-600 text-lg leading-none px-1 cursor-pointer"
                    >
                        ×
                    </button>
                </div>

                <div class="space-y-3 text-xs text-gray-600 leading-relaxed">
                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-3.5 space-y-1">
                        <p class="font-bold text-gray-900">Lokasi & Jam Layanan</p>
                        <p>Kampus B Dharmawangsa, Surabaya (Gedung A, B & C)</p>
                        <p class="text-gray-500">Senin–Jumat: 07.00–20.30 WIB | Sabtu: 08.00–15.00 WIB</p>
                    </div>

                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-3.5 space-y-1">
                        <p class="font-bold text-gray-900">Tips Cepat Sebelum Menghubungi Admin</p>
                        <ul class="list-disc pl-4 space-y-1 text-gray-600">
                            <li>Pastikan kategori <span class="font-semibold">Mahasiswa</span> atau <span class="font-semibold">Pengelola</span> sesuai akun.</li>
                            <li>Periksa kesesuaian NIM/NIP dan email yang didaftarkan saat registrasi.</li>
                            <li>Jika belum punya akun, gunakan menu <span class="font-semibold">Registrasi</span> di pojok kanan atas.</li>
                        </ul>
                    </div>
                </div>

                <div class="flex justify-end pt-1">
                    <button
                        type="button"
                        @click="modalBantuan = false"
                        class="px-5 py-2 text-xs font-semibold text-white bg-[#0B2E59] hover:bg-blue-900 rounded-xl transition cursor-pointer"
                    >
                        Mengerti
                    </button>
                </div>
            </div>
        </div>

    </div>
</body>
</html>