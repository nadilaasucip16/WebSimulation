<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi – OOP Learn</title>
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

        @include('_navbar', ['navTitle' => 'Informasi'])

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-1">Informasi Media Pembelajaran</h2>
                <p class="text-sm text-gray-500">Gambaran umum sistem, tujuan pengembangan, cakupan materi, dan tahapan pembelajaran yang diterapkan.</p>
            </div>

            {{-- ── Tujuan Pengembangan ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Tujuan Pengembangan</h3>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                    Media pembelajaran ini dikembangkan sebagai pendukung kegiatan belajar mengajar mata pelajaran
                    <span class="font-semibold text-gray-800">Pemrograman Berorientasi Objek (PBO)</span> untuk peserta didik
                    Sekolah Menengah Kejuruan (SMK). Sistem ini dirancang agar peserta didik dapat membangun pemahaman
                    konseptual secara bertahap melalui pendekatan pembelajaran yang terstruktur dan interaktif.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="flex items-start gap-2.5 bg-green-50 rounded-xl p-3.5">
                        <span class="w-5 h-5 rounded-full bg-green-500 text-white text-[10px] font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
                        <p class="text-xs text-gray-700 leading-snug">Membangun pemahaman konsep OOP secara mandiri dan aktif</p>
                    </div>
                    <div class="flex items-start gap-2.5 bg-green-50 rounded-xl p-3.5">
                        <span class="w-5 h-5 rounded-full bg-green-500 text-white text-[10px] font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
                        <p class="text-xs text-gray-700 leading-snug">Menyediakan pengalaman belajar interaktif berbasis simulasi dan blueprint</p>
                    </div>
                    <div class="flex items-start gap-2.5 bg-green-50 rounded-xl p-3.5">
                        <span class="w-5 h-5 rounded-full bg-green-500 text-white text-[10px] font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
                        <p class="text-xs text-gray-700 leading-snug">Mengukur peningkatan pemahaman melalui pretest dan posttest terstandar</p>
                    </div>
                </div>
            </div>

            {{-- ── Cakupan Materi ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Cakupan Materi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Enkapsulasi --}}
                    <div class="rounded-xl border border-green-100 bg-green-50/50 p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded-full uppercase tracking-wide">Pertemuan 1</span>
                        </div>
                        <h4 class="text-sm font-bold text-gray-900 mb-2">Enkapsulasi</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Konsep pembungkusan data dan method ke dalam sebuah class. Peserta didik mempelajari
                            penerapan <em>access modifier</em> (public, private, protected) untuk mengatur hak akses
                            atribut dan method pada sebuah objek.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="text-[10px] bg-white border border-green-200 text-green-700 px-2 py-0.5 rounded-full font-medium">Access Modifier</span>
                            <span class="text-[10px] bg-white border border-green-200 text-green-700 px-2 py-0.5 rounded-full font-medium">Class & Object</span>
                            <span class="text-[10px] bg-white border border-green-200 text-green-700 px-2 py-0.5 rounded-full font-medium">Getter & Setter</span>
                        </div>
                    </div>

                    {{-- Inheritance --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50/50 p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-bold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full uppercase tracking-wide">Pertemuan 2</span>
                        </div>
                        <h4 class="text-sm font-bold text-gray-900 mb-2">Inheritance</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Mekanisme pewarisan sifat dan perilaku dari class induk (<em>parent class</em>) kepada
                            class turunan (<em>child class</em>). Peserta didik memahami bagaimana kode dapat
                            digunakan kembali dan diperluas melalui hubungan pewarisan.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="text-[10px] bg-white border border-blue-200 text-blue-700 px-2 py-0.5 rounded-full font-medium">Parent & Child Class</span>
                            <span class="text-[10px] bg-white border border-blue-200 text-blue-700 px-2 py-0.5 rounded-full font-medium">Method Override</span>
                            <span class="text-[10px] bg-white border border-blue-200 text-blue-700 px-2 py-0.5 rounded-full font-medium">Extends</span>
                        </div>
                    </div>

                    {{-- Enkapsulasi & Inheritance (P3) --}}
                    <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-bold text-purple-600 bg-purple-100 px-2 py-0.5 rounded-full uppercase tracking-wide">Pertemuan 3</span>
                        </div>
                        <h4 class="text-sm font-bold text-gray-900 mb-2">Enkapsulasi &amp; Inheritance</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Penerapan terpadu konsep enkapsulasi dan inheritance dalam satu program. Peserta didik
                            merancang hierarki class yang menggabungkan pembungkusan data dengan pewarisan
                            untuk membangun struktur program yang lebih kompleks.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="text-[10px] bg-white border border-purple-200 text-purple-700 px-2 py-0.5 rounded-full font-medium">Hierarki Class</span>
                            <span class="text-[10px] bg-white border border-purple-200 text-purple-700 px-2 py-0.5 rounded-full font-medium">Integrasi Konsep</span>
                            <span class="text-[10px] bg-white border border-purple-200 text-purple-700 px-2 py-0.5 rounded-full font-medium">Studi Kasus</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ── Tahapan Needham Lima Fase ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Tahapan Pembelajaran Needham Lima Fase</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Model konstruktivisme yang diterapkan pada setiap pertemuan</p>
                    </div>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed mt-3 mb-6">
                    Setiap pertemuan dalam media ini mengikuti model pembelajaran <span class="font-semibold text-gray-800">Needham Lima Fase</span>,
                    sebuah model konstruktivisme yang mendorong peserta didik membangun pengetahuan secara aktif melalui
                    tahapan yang sistematis — dari pengenalan hingga refleksi.
                </p>

                {{-- Phase Steps --}}
                <div class="relative">
                    {{-- Connector line (hidden on mobile) --}}
                    <div class="hidden lg:block absolute top-[2.2rem] left-[2.2rem] right-[2.2rem] h-0.5 bg-gradient-to-r from-green-200 via-blue-200 to-purple-200 z-0"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 relative z-10">

                        {{-- Fase 1 --}}
                        <div class="flex flex-col items-center text-center">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-2xl bg-green-100 border-2 border-green-200 flex flex-col items-center justify-center mb-3 shrink-0">
                                <span class="text-[10px] font-bold text-green-500 uppercase tracking-wider leading-none mb-0.5">Fase</span>
                                <span class="text-2xl font-black text-green-600 leading-none">1</span>
                            </div>
                            <p class="text-xs font-bold text-gray-900 mb-1">Orientasi</p>
                            <p class="text-[11px] text-gray-500 leading-snug">Pengenalan topik dan pembangkitan rasa ingin tahu peserta didik</p>
                        </div>

                        {{-- Fase 2 --}}
                        <div class="flex flex-col items-center text-center">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-2xl bg-sky-100 border-2 border-sky-200 flex flex-col items-center justify-center mb-3 shrink-0">
                                <span class="text-[10px] font-bold text-sky-500 uppercase tracking-wider leading-none mb-0.5">Fase</span>
                                <span class="text-2xl font-black text-sky-600 leading-none">2</span>
                            </div>
                            <p class="text-xs font-bold text-gray-900 mb-1">Pencetusan Ide</p>
                            <p class="text-[11px] text-gray-500 leading-snug">Eksplorasi pengetahuan awal dan ide-ide yang dimiliki peserta didik</p>
                        </div>

                        {{-- Fase 3 --}}
                        <div class="flex flex-col items-center text-center">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-2xl bg-blue-100 border-2 border-blue-200 flex flex-col items-center justify-center mb-3 shrink-0">
                                <span class="text-[10px] font-bold text-blue-500 uppercase tracking-wider leading-none mb-0.5">Fase</span>
                                <span class="text-2xl font-black text-blue-600 leading-none">3</span>
                            </div>
                            <p class="text-xs font-bold text-gray-900 mb-1">Penstrukturan</p>
                            <p class="text-[11px] text-gray-500 leading-snug">Pembentukan dan penyusunan konsep yang tepat melalui penjelasan terstruktur</p>
                        </div>

                        {{-- Fase 4 --}}
                        <div class="flex flex-col items-center text-center">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-2xl bg-violet-100 border-2 border-violet-200 flex flex-col items-center justify-center mb-3 shrink-0">
                                <span class="text-[10px] font-bold text-violet-500 uppercase tracking-wider leading-none mb-0.5">Fase</span>
                                <span class="text-2xl font-black text-violet-600 leading-none">4</span>
                            </div>
                            <p class="text-xs font-bold text-gray-900 mb-1">Aplikasi</p>
                            <p class="text-[11px] text-gray-500 leading-snug">Penerapan konsep dalam latihan, simulasi, dan perancangan blueprint class</p>
                        </div>

                        {{-- Fase 5 --}}
                        <div class="flex flex-col items-center text-center">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-2xl bg-purple-100 border-2 border-purple-200 flex flex-col items-center justify-center mb-3 shrink-0">
                                <span class="text-[10px] font-bold text-purple-500 uppercase tracking-wider leading-none mb-0.5">Fase</span>
                                <span class="text-2xl font-black text-purple-600 leading-none">5</span>
                            </div>
                            <p class="text-xs font-bold text-gray-900 mb-1">Refleksi</p>
                            <p class="text-[11px] text-gray-500 leading-snug">Peninjauan ulang proses belajar dan penguatan pemahaman yang telah diperoleh</p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── Cara Penggunaan ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Cara Penggunaan Sistem</h3>
                </div>

                <ol class="space-y-3">
                    @foreach([
                        ['Kerjakan Pretest terlebih dahulu melalui menu Assessment untuk mengukur pengetahuan awal sebelum pembelajaran.', 'Assessment'],
                        ['Pelajari materi pada menu Materi sebagai referensi konsep Enkapsulasi dan Inheritance.', 'Materi'],
                        ['Ikuti setiap Activity (Pertemuan 1–3) secara berurutan. Setiap pertemuan terdiri dari lima fase pembelajaran Needham.', 'Activity'],
                        ['Setelah menyelesaikan semua pertemuan, kerjakan Posttest melalui menu Assessment.', 'Assessment'],
                        ['Pantau perkembangan nilaimu melalui menu Hasil Belajar.', 'Hasil Belajar'],
                    ] as $i => [$step, $menu])
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">{{ $i + 1 }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $step }}
                            <span class="inline-block ml-1 text-[10px] font-semibold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded-md">{{ $menu }}</span>
                        </p>
                    </li>
                    @endforeach
                </ol>
            </div>

        </div>
    </main>
</div>

</body>
</html>
