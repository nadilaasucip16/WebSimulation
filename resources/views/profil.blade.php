<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya – OOP Learn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50">

<div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

    @include('sidebar-siswa')

    <main class="flex-1 flex flex-col overflow-hidden min-w-0">

        @include('_navbar', ['navTitle' => 'Profil Saya'])

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

            @if(session('success'))
                <div class="mb-5 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('success_password'))
                <div class="mb-5 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                    {{ session('success_password') }}
                </div>
            @endif

            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-1">Profil Peserta Didik</h2>
                <p class="text-sm text-gray-500">Lihat dan perbarui data diri serta kata sandi akunmu.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Left: Profile Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'S') }}&background=dcfce7&color=166534&size=128&bold=true"
                             class="w-20 h-20 rounded-full mx-auto mb-4 border-2 border-gray-100"
                             alt="Foto Profil">
                        <h3 class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ auth()->user()->email }}</p>

                        @if(auth()->user()->kelas)
                            <p class="mt-3 text-xs font-medium text-gray-600">Kelas {{ auth()->user()->kelas }}</p>
                        @else
                            <p class="mt-3 text-xs text-gray-400 italic">Kelas belum diisi</p>
                        @endif

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400">Peserta Didik</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Forms --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Edit Data Diri --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="mb-5 pb-4 border-b border-gray-100">
                            <h4 class="text-sm font-bold text-gray-900">Edit Data Diri</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Perbarui nama lengkap dan kelas</p>
                        </div>

                        @if($errors->profile->any())
                            <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3 space-y-0.5">
                                @foreach($errors->profile->all() as $e)
                                    <p>{{ $e }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profil.update') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Nama Lengkap</label>
                                    <input type="text" name="name"
                                           value="{{ old('name', auth()->user()->name) }}"
                                           class="w-full px-3.5 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 bg-white focus:border-green-400 focus:outline-none transition"
                                           placeholder="Nama lengkap" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Kelas</label>
                                    <input type="text" name="kelas"
                                           value="{{ old('kelas', auth()->user()->kelas) }}"
                                           class="w-full px-3.5 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 bg-white focus:border-green-400 focus:outline-none transition"
                                           placeholder="Contoh: XI RPL 1">
                                </div>
                                <div>
                                    <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Ganti Kata Sandi --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="mb-5 pb-4 border-b border-gray-100">
                            <h4 class="text-sm font-bold text-gray-900">Ganti Kata Sandi</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Pastikan kata sandi baru minimal 8 karakter</p>
                        </div>

                        @if($errors->password_change->any())
                            <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3 space-y-0.5">
                                @foreach($errors->password_change->all() as $e)
                                    <p>{{ $e }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profil.password') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Kata Sandi Saat Ini</label>
                                    <input type="password" name="current_password"
                                           class="w-full px-3.5 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 bg-white focus:border-amber-400 focus:outline-none transition"
                                           placeholder="••••••••">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Kata Sandi Baru</label>
                                    <input type="password" name="password"
                                           class="w-full px-3.5 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 bg-white focus:border-amber-400 focus:outline-none transition"
                                           placeholder="Minimal 8 karakter">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" name="password_confirmation"
                                           class="w-full px-3.5 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 bg-white focus:border-amber-400 focus:outline-none transition"
                                           placeholder="Ulangi kata sandi baru">
                                </div>
                                <div>
                                    <button type="submit"
                                            class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                                        Perbarui Kata Sandi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>
