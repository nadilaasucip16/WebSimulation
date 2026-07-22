<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi ICS - OOP Learn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50">

<div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

    @include('sidebar-siswa')

    <main class="flex-1 flex flex-col overflow-hidden">

        @include('_navbar', ['navTitle' => 'Simulasi Interaktif OOP'])

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

            {{-- Page header --}}
            <div class="mb-6">
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-700 bg-green-50 px-3 py-1.5 rounded-full mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    ICS — Interactive Computer Simulation
                </span>
                <h2 class="text-xl font-bold text-gray-900 mb-1">Simulasi Interaktif OOP</h2>
                <p class="text-sm text-gray-500">Rancang class diagram, tulis kode Python, dan jalankan simulasi langkah demi langkah untuk memahami konsep OOP secara mendalam.</p>
            </div>

            {{-- Cara kerja (3 fase) --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">3 Fase Simulasi</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([
                        ['1','Blueprint Class','Rancang struktur class dengan atribut, method, dan hubungan pewarisan menggunakan visual class builder.','bg-violet-50 text-violet-600','border-violet-100'],
                        ['2','Editor Kode','Kode Python di-generate otomatis dari blueprint. Lengkapi logika method dan tulis prediksimu sebelum menjalankan.','bg-amber-50 text-amber-600','border-amber-100'],
                        ['3','Simulasi Player','Jalankan kode langkah demi langkah — lihat state objek, output console, dan narasi penjelasan konsep OOP secara real-time.','bg-green-50 text-green-600','border-green-100'],
                    ] as [$n, $judul, $desc, $iconColor, $border])
                    <div class="flex gap-3 p-4 rounded-xl border {{ $border }} {{ explode(' ', $iconColor)[0] }}">
                        <div class="w-7 h-7 rounded-full {{ $iconColor }} font-bold text-sm flex items-center justify-center shrink-0">{{ $n }}</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-0.5">{{ $judul }}</p>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Pilih konsep --}}
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Pilih Konsep untuk Memulai</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

                {{-- Enkapsulasi --}}
                <a href="{{ route('blueprint.enkapsulasi') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-rose-200 hover:shadow-md transition-all block">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-100 uppercase tracking-wide">Enkapsulasi</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-2 group-hover:text-rose-600 transition">Simulasi Enkapsulasi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-5">Rancang class dengan atribut <code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded font-mono">__private</code> dan <code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded font-mono">_protected</code>, tambahkan getter &amp; setter, lalu uji access modifier secara interaktif.</p>
                    <div class="flex items-center gap-2 text-xs font-semibold text-rose-600">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                        Buka ICS Enkapsulasi
                    </div>
                </a>

                {{-- Inheritance --}}
                <a href="{{ route('blueprint.inheritance') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-violet-200 hover:shadow-md transition-all block">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-violet-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                        </div>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-violet-50 text-violet-600 border border-violet-100 uppercase tracking-wide">Inheritance</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-2 group-hover:text-violet-600 transition">Simulasi Inheritance</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-5">Rancang class induk dan class anak, gunakan <code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded font-mono">super().__init__()</code> untuk mewarisi atribut, dan lihat pewarisan method secara visual dalam simulasi.</p>
                    <div class="flex items-center gap-2 text-xs font-semibold text-violet-600">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                        Buka ICS Inheritance
                    </div>
                </a>

            </div>

            {{-- Skenario dari DB (jika ada) --}}
            @if($skenarios->isNotEmpty())
            <div class="mb-6">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Skenario Preset dari Guru</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($skenarios as $s)
                    @php
                        $targetRoute = $s->materi === 'inheritance'
                            ? route('blueprint.inheritance')
                            : route('blueprint.enkapsulasi');
                        $colors = match($s->materi) {
                            'enkapsulasi' => ['bg-rose-50','text-rose-600','bg-rose-50 text-rose-700 border-rose-100'],
                            'inheritance' => ['bg-violet-50','text-violet-600','bg-violet-50 text-violet-700 border-violet-100'],
                            default       => ['bg-blue-50','text-blue-600','bg-blue-50 text-blue-700 border-blue-100'],
                        };
                    @endphp
                    <a href="{{ $targetRoute }}"
                       class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 hover:border-gray-200 hover:shadow-md transition-all flex flex-col gap-2 group">
                        <div class="flex items-center justify-between">
                            <div class="w-8 h-8 rounded-lg {{ $colors[0] }} flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 {{ $colors[1] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    @if($s->materi === 'enkapsulasi')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                    @endif
                                </svg>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full border {{ $colors[2] }} uppercase tracking-wide">{{ $s->materi }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-gray-900 leading-snug">{{ $s->judul }}</p>
                            @if($s->deskripsi)
                            <p class="text-xs text-gray-400 mt-1 leading-snug line-clamp-2">{{ $s->deskripsi }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-1.5 text-xs font-medium {{ $colors[1] }} mt-auto pt-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                            Buka di ICS
                        </div>
                    </a>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mt-2">* Skenario preset tersedia di dalam ICS pada bagian "⚡ Muat Contoh Siap Jalankan".</p>
            </div>
            @endif

            {{-- Info fitur ICS --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Fitur dalam ICS</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach([
                        ['Diagram Class Visual','Lihat struktur class terbentuk otomatis saat kamu menambahkan atribut dan method.'],
                        ['Pyodide — Python di Browser','Kode Python dijalankan langsung di browser tanpa perlu install apapun.'],
                        ['Step-by-step Trace','Navigasi setiap baris kode — lihat bagaimana state objek berubah di memori.'],
                        ['Uji Access Modifier','Simulasikan akses atribut dari luar class, dalam class, dan subclass secara interaktif.'],
                        ['Mini Quiz','Evaluasi pemahaman konsep dengan soal pilihan ganda setelah simulasi selesai.'],
                        ['Glosarium OOP','Referensi cepat istilah-istilah OOP tersedia kapan saja selama simulasi.'],
                    ] as [$f, $d])
                    <div class="flex gap-3 items-start">
                        <svg class="w-4 h-4 text-green-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">{{ $f }}</p>
                            <p class="text-xs text-gray-400 leading-snug">{{ $d }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </main>

</div>

</body>
</html>
