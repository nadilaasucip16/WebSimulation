<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan {{ $pertemuan }} – Fase {{ $fase }} – {{ $topikNama }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }

        @keyframes ring-out {
            0%, 100% { box-shadow: 0 0 0 0 var(--ring-color, rgba(37,99,235,0.4)); }
            60%       { box-shadow: 0 0 0 11px transparent; }
        }
        .btn-pulse-blue   { --ring-color: rgba(37,99,235,0.4);  animation: ring-out 2s ease-in-out infinite; }
        .btn-pulse-purple { --ring-color: rgba(147,51,234,0.4); animation: ring-out 2s ease-in-out infinite; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

    @include('sidebar-siswa')

    <main class="flex-1 flex flex-col overflow-hidden">

        @include('_navbar', ['navTitle' => 'Pertemuan ' . $pertemuan . ' – Fase ' . $fase . ' – ' . $faseNama])

        <div class="flex-1 overflow-y-auto p-8">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-10 min-h-[80vh] relative">

            {{-- Phase badge + Pertemuan badge --}}
            <div class="flex items-center justify-between gap-3 mb-5 flex-wrap">
                <div class="flex items-center gap-3 flex-wrap">
                    {{-- Fase badge --}}
                    @if($warna === 'blue')
                    <span class="inline-flex items-center gap-1.5 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    @else
                    <span class="inline-flex items-center gap-1.5 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    @endif
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Fase {{ $fase }} dari 5
                    </span>
                    <span class="text-xs text-gray-400 font-medium">Model Needham Lima Fase</span>
                    {{-- Pertemuan badge --}}
                    @if($warna === 'blue')
                    <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold px-3 py-1 rounded-full">
                    @else
                    <span class="inline-flex items-center gap-1.5 bg-purple-50 text-purple-700 border border-purple-200 text-xs font-semibold px-3 py-1 rounded-full">
                    @endif
                        Pertemuan {{ $pertemuan }} · {{ $topikNama }}
                    </span>
                </div>
            </div>

            {{-- Title --}}
            <h2 class="text-2xl font-extrabold text-gray-900 mb-1">
                {{ $faseNama }}
                @if($warna === 'blue')
                <span class="text-blue-600">— {{ $topikNama }}</span>
                @else
                <span class="text-purple-600">— {{ $topikNama }}</span>
                @endif
            </h2>
            <p class="text-sm text-gray-500 mb-10">
                Pertemuan {{ $pertemuan }} · Pemrograman Berorientasi Objek
            </p>

            {{-- Needham Phase Steps (visual indicator) --}}
            <div class="flex items-center gap-0 mb-10 overflow-x-auto pb-2">
                @php
                $faseList = [
                    1 => 'Orientasi',
                    2 => 'Pencetusan Ide',
                    3 => 'Penstrukturan',
                    4 => 'Aplikasi',
                    5 => 'Refleksi',
                ];
                $activeColor = $warna === 'blue' ? '#2563eb' : '#9333ea';
                $lightColor  = $warna === 'blue' ? '#eff6ff' : '#faf5ff';
                $textColor   = $warna === 'blue' ? '#1d4ed8' : '#7e22ce';
                @endphp
                @foreach($faseList as $num => $nama)
                <div class="flex items-center">
                    <div class="flex flex-col items-center gap-1 px-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2 transition-all"
                             style="{{ $num <= $fase
                                 ? "background:{$activeColor};border-color:{$activeColor};color:white;"
                                 : 'background:white;border-color:#e5e7eb;color:#9ca3af;' }}">
                            {{ $num <= $fase ? '✓' : $num }}
                        </div>
                        <span class="text-[10px] font-medium whitespace-nowrap"
                              style="{{ $num === $fase ? "color:{$textColor};" : 'color:#9ca3af;' }}">
                            {{ $nama }}
                        </span>
                    </div>
                    @if($num < 5)
                    <div class="h-0.5 w-8 flex-shrink-0"
                         style="{{ $num < $fase ? "background:{$activeColor};" : 'background:#e5e7eb;' }}"></div>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 2 · FASE 1 — Orientasi: Inheritance
            ═══════════════════════════════════════════════════════════ --}}
            @if($pertemuan == 2 && $fase == 1)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🎮</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Studi Kasus: Mengembangkan Sistem Karakter Gim (RPG)
                        </h3>
                        <p class="text-sm text-blue-600 font-medium">Apersepsi · Membangun konteks masalah</p>
                    </div>
                </div>

                {{-- Opening paragraph --}}
                <p class="text-gray-700 text-base leading-relaxed">
                    Bayangkan kamu direkrut menjadi programmer untuk sebuah studio gim besar.
                    Tugas pertamamu adalah membuat dua jenis karakter:
                    <strong class="text-gray-900">Hero</strong> (Pahlawan) dan
                    <strong class="text-gray-900">Monster</strong>.
                </p>

                {{-- Character cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Hero card --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl select-none">🦸</span>
                            <span class="font-bold text-blue-800">Hero (Pahlawan)</span>
                        </div>
                        <p class="text-[11px] text-blue-500 font-bold uppercase tracking-widest mb-3">
                            Data yang dibutuhkan:
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-blue-200 px-2 py-0.5 rounded-md text-blue-700 font-mono">nama</code>
                                <span class="text-sm text-gray-600">nama karakter</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-blue-200 px-2 py-0.5 rounded-md text-blue-700 font-mono">nyawa</code>
                                <span class="text-sm text-gray-600">HP (Health Points)</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-blue-200 px-2 py-0.5 rounded-md text-blue-700 font-mono">energi_sihir</code>
                                <span class="text-sm text-gray-600">Mana Points</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Monster card --}}
                    <div class="bg-violet-50 border border-violet-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl select-none">👾</span>
                            <span class="font-bold text-violet-800">Monster</span>
                        </div>
                        <p class="text-[11px] text-violet-500 font-bold uppercase tracking-widest mb-3">
                            Data yang dibutuhkan:
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-violet-200 px-2 py-0.5 rounded-md text-violet-700 font-mono">nama</code>
                                <span class="text-sm text-gray-600">nama karakter</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-violet-200 px-2 py-0.5 rounded-md text-violet-700 font-mono">nyawa</code>
                                <span class="text-sm text-gray-600">HP (Health Points)</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-violet-200 px-2 py-0.5 rounded-md text-violet-700 font-mono">elemen_serangan</code>
                                <span class="text-sm text-gray-600">Elemen serangan</span>
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- Pemantik question box --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 flex gap-4">
                    <div class="w-10 h-10 bg-amber-400 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                        <span class="text-white text-xl font-black leading-none">?</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">Pertanyaan Pemantik</p>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Keduanya sama-sama memiliki
                            <code class="bg-amber-100 border border-amber-200 text-amber-800 font-mono text-sm px-1.5 py-0.5 rounded">nama</code>
                            dan
                            <code class="bg-amber-100 border border-amber-200 text-amber-800 font-mono text-sm px-1.5 py-0.5 rounded">nyawa</code>.
                            Jika di dalam gim tersebut terdapat
                            <strong class="text-amber-800">100 jenis Hero</strong> dan
                            <strong class="text-amber-800">500 jenis Monster</strong>,
                            apakah kamu sebagai programmer harus mengetik ulang kode untuk variabel
                            <code class="bg-amber-100 border border-amber-200 text-amber-800 font-mono text-sm px-1.5 py-0.5 rounded">nama</code>
                            dan
                            <code class="bg-amber-100 border border-amber-200 text-amber-800 font-mono text-sm px-1.5 py-0.5 rounded">nyawa</code>
                            sebanyak <strong class="text-amber-800">600 kali</strong>?
                        </p>
                    </div>
                </div>

                <p class="text-gray-400 italic text-sm">Pikirkan jawabanmu sebelum melanjutkan ke fase berikutnya.</p>

            </div>

            {{-- Navigation button --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p2.fase2') }}"
                   class="btn-pulse-blue inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 2 – Pencetusan Ide
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 2 · FASE 2 — Pencetusan Ide: Inheritance
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 2 && $fase == 2)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">💡</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Pencetusan Ide: Menemukan Solusi yang Efisien
                        </h3>
                        <p class="text-sm text-blue-600 font-medium">Perbandingan pendekatan · Menemukan pola</p>
                    </div>
                </div>

                {{-- Perbandingan 2 kolom --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Kolom kiri: Tidak efisien --}}
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center shrink-0">✕</span>
                            <span class="font-bold text-red-800 text-sm">Menulis Ulang (Tidak Efisien)</span>
                        </div>
                        <div class="bg-white border border-red-100 rounded-xl p-4 font-mono text-xs text-gray-700 space-y-1 leading-relaxed">
                            <p class="text-purple-600 font-semibold">class Hero:</p>
                            <p class="ml-4 text-gray-500"># data umum diketik di sini</p>
                            <p class="ml-4"><span class="text-blue-600">nama</span> = <span class="text-red-500 font-bold">???</span></p>
                            <p class="ml-4"><span class="text-blue-600">nyawa</span> = <span class="text-red-500 font-bold">???</span></p>
                            <p class="ml-4"><span class="text-blue-600">energi_sihir</span> = ...</p>
                            <p class="mt-2 text-purple-600 font-semibold">class Monster:</p>
                            <p class="ml-4 text-gray-500"># data umum DIKETIK ULANG!</p>
                            <p class="ml-4"><span class="text-blue-600">nama</span> = <span class="text-red-500 font-bold">???</span></p>
                            <p class="ml-4"><span class="text-blue-600">nyawa</span> = <span class="text-red-500 font-bold">???</span></p>
                            <p class="ml-4"><span class="text-blue-600">elemen_serangan</span> = ...</p>
                        </div>
                        <p class="text-red-600 text-xs font-medium mt-3">
                            ↑ Bayangkan 600 class harus seperti ini semua!
                        </p>
                    </div>

                    {{-- Kolom kanan: Efisien --}}
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-full bg-green-500 text-white text-xs font-black flex items-center justify-center shrink-0">✓</span>
                            <span class="font-bold text-green-800 text-sm">Menggunakan Blueprint Induk</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 py-2">
                            {{-- Parent class box --}}
                            <div class="w-full bg-white border-2 border-green-400 rounded-xl px-4 py-3 text-center shadow-sm">
                                <p class="font-mono text-sm font-bold text-green-700">class Karakter</p>
                                <p class="text-xs text-gray-500 mt-1">nama, nyawa</p>
                            </div>
                            {{-- Arrow down --}}
                            <div class="flex gap-8 items-start">
                                <div class="flex flex-col items-center">
                                    <div class="w-px h-5 bg-green-400"></div>
                                    <svg class="w-3 h-3 text-green-500 -mt-px" viewBox="0 0 12 12" fill="currentColor">
                                        <path d="M6 12 L0 4 L12 4 Z"/>
                                    </svg>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-px h-5 bg-green-400"></div>
                                    <svg class="w-3 h-3 text-green-500 -mt-px" viewBox="0 0 12 12" fill="currentColor">
                                        <path d="M6 12 L0 4 L12 4 Z"/>
                                    </svg>
                                </div>
                            </div>
                            {{-- Child class boxes --}}
                            <div class="flex gap-3 w-full">
                                <div class="flex-1 bg-white border border-green-300 rounded-xl px-3 py-2.5 text-center">
                                    <p class="font-mono text-xs font-bold text-blue-700">class Hero</p>
                                    <p class="text-[10px] text-gray-400 mt-0.5">+ energi_sihir</p>
                                </div>
                                <div class="flex-1 bg-white border border-green-300 rounded-xl px-3 py-2.5 text-center">
                                    <p class="font-mono text-xs font-bold text-violet-700">class Monster</p>
                                    <p class="text-[10px] text-gray-400 mt-0.5">+ elemen_serangan</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-green-700 text-xs font-medium mt-3">
                            ↑ Data umum cukup ditulis sekali di class induk!
                        </p>
                    </div>

                </div>

                {{-- Penjelasan --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Daripada menulis ulang, programmer cerdas membuat satu <strong class="text-blue-700">cetakan utama (Induk / Parent Class)</strong>
                        yang berisi data umum, lalu <strong class="text-blue-700">mewariskannya</strong> ke cetakan khusus
                        (Anak / Child Class). Konsep inilah yang disebut <strong class="text-gray-900">Inheritance</strong>.
                    </p>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p2.fase3') }}"
                   class="btn-pulse-blue inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 3 – Penstrukturan Ide
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 2 · FASE 3 — Penstrukturan Ide: Inheritance
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 2 && $fase == 3)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🏗️</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Penstrukturan Ide: Konsep Inheritance
                        </h3>
                        <p class="text-sm text-blue-600 font-medium">Terminologi & struktur resmi OOP</p>
                    </div>
                </div>

                {{-- Konsep cards --}}
                <div class="space-y-4">

                    {{-- 1. Parent Class --}}
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-blue-700 font-black text-lg leading-none">1</span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900">Parent Class</span>
                                <span class="text-xs text-gray-400 font-mono">(Superclass)</span>
                                <code class="text-xs bg-blue-50 border border-blue-200 text-blue-700 font-mono px-2 py-0.5 rounded">class Karakter</code>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Class utama yang berisi properti dan method <strong>umum</strong>.
                                Properti ini akan diwariskan secara otomatis ke semua class anak.
                                <span class="text-blue-600 font-medium">Contoh: class Karakter menyimpan nama dan nyawa.</span>
                            </p>
                        </div>
                    </div>

                    {{-- 2. Child Class --}}
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-violet-700 font-black text-lg leading-none">2</span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900">Child Class</span>
                                <span class="text-xs text-gray-400 font-mono">(Subclass)</span>
                                <code class="text-xs bg-violet-50 border border-violet-200 text-violet-700 font-mono px-2 py-0.5 rounded">class Hero</code>
                                <code class="text-xs bg-violet-50 border border-violet-200 text-violet-700 font-mono px-2 py-0.5 rounded">class Monster</code>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Class yang <strong>menerima warisan</strong> dan bisa menambahkan properti uniknya sendiri.
                                <span class="text-violet-600 font-medium">Contoh: Hero punya energi_sihir, Monster punya elemen_serangan.</span>
                            </p>
                        </div>
                    </div>

                    {{-- 3. Keyword extends --}}
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-green-700 font-black text-lg leading-none">3</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900">Keyword Pewarisan</span>
                                <code class="text-xs bg-green-50 border border-green-200 text-green-700 font-mono px-2 py-0.5 rounded">extends</code>
                                <span class="text-gray-400 text-xs">/ notasi</span>
                                <code class="text-xs bg-green-50 border border-green-200 text-green-700 font-mono px-2 py-0.5 rounded">class Anak(Induk)</code>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Cara memberitahu program bahwa sebuah class adalah anak dari class lain.
                                Di Python, ditulis dengan meletakkan nama parent di dalam tanda kurung.
                            </p>
                            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-mono text-xs text-gray-700 space-y-0.5">
                                <p><span class="text-purple-600 font-semibold">class</span> <span class="text-blue-700 font-semibold">Hero</span>(<span class="text-green-700 font-semibold">Karakter</span>):  <span class="text-gray-400"># Hero mewarisi Karakter</span></p>
                                <p class="ml-4"><span class="text-blue-600">energi_sihir</span> = <span class="text-orange-500">100</span></p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Highlight box --}}
                <div class="bg-blue-600 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-blue-100 uppercase tracking-wider mb-1.5">Ingat!</p>
                        <p class="text-white text-sm leading-relaxed">
                            Class Anak akan selalu memiliki <strong>SEMUA</strong> atribut dan method milik Class Induk,
                            <strong>ditambah</strong> dengan miliknya sendiri — bukan menggantikan, melainkan memperluas.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p2.fase4') }}"
                   class="btn-pulse-blue inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 4 – Aplikasi
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 2 · FASE 5 — Refleksi: Inheritance
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 2 && $fase == 5)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🎯</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Refleksi: Apa yang Kita Pelajari?
                        </h3>
                        <p class="text-sm text-blue-600 font-medium">Evaluasi pemahaman · Rangkuman keuntungan</p>
                    </div>
                </div>

                {{-- Intro --}}
                <p class="text-gray-700 text-base leading-relaxed">
                    Selamat! Kamu telah menyelesaikan materi <strong class="text-gray-900">Inheritance</strong>.
                    Berikut adalah keuntungan nyata yang kamu dapatkan dengan menerapkan konsep ini dalam pemrograman:
                </p>

                {{-- Success checklist --}}
                <div class="space-y-3">

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">Menghemat Waktu Penulisan Kode <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Reusability</span></p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Kode yang ditulis di class induk <strong>cukup ditulis sekali</strong>, lalu digunakan oleh ratusan class anak tanpa perlu mengulang.
                                Ini menghemat waktu dan mengurangi potensi kesalahan pengetikan.
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">Memudahkan Perbaikan Kode <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Maintainability</span></p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Jika aturan <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">nyawa</code> ingin diubah (misalnya maksimum 9999),
                                cukup ubah di <strong>satu tempat</strong> — class <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">Karakter</code> —
                                dan semua class anak otomatis mengikutinya.
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">Membuat Struktur Program Lebih Logis <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Readability</span></p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Kode mencerminkan dunia nyata: <em>Hero adalah Karakter, Monster adalah Karakter</em>.
                                Programmer lain yang membaca kode langsung mengerti hubungan antar class tanpa perlu penjelasan panjang.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Penutup --}}
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center">
                    <p class="text-2xl mb-2">🎉</p>
                    <p class="text-gray-700 font-semibold">Pertemuan 2 – Inheritance selesai!</p>
                    <p class="text-gray-500 text-sm mt-1">Lanjutkan ke pertemuan berikutnya dari dashboard.</p>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <form method="POST" action="{{ route('p2.fase5.complete') }}">
                    @csrf
                    <button type="submit"
                            class="btn-pulse-blue inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Selesai · Kembali ke Dashboard
                    </button>
                </form>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 3 · FASE 1 — Orientasi: Proyek Akhir
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 3 && $fase == 1)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🏫</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Studi Kasus: Sistem Manajemen Akun Sekolah
                        </h3>
                        <p class="text-sm text-purple-600 font-medium">Apersepsi · Menggabungkan Enkapsulasi & Inheritance</p>
                    </div>
                </div>

                {{-- Opening paragraph --}}
                <p class="text-gray-700 text-base leading-relaxed">
                    Kamu ditugaskan merancang <strong class="text-gray-900">pondasi keamanan</strong> untuk
                    portal web sekolah. Sistem ini akan dipakai oleh
                    <strong class="text-gray-900">Guru</strong> dan <strong class="text-gray-900">Siswa</strong>.
                    Keduanya butuh fitur login (password), tapi data profesinya berbeda.
                </p>

                {{-- Problem illustration --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl select-none">👩‍🏫</span>
                            <span class="font-bold text-indigo-800">Guru</span>
                        </div>
                        <p class="text-[11px] text-indigo-500 font-bold uppercase tracking-widest mb-3">Data Khusus:</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-indigo-200 px-2 py-0.5 rounded-md text-indigo-700 font-mono">mata_pelajaran</code>
                                <span class="text-sm text-gray-600">yang diajar</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-indigo-200 px-2 py-0.5 rounded-md text-indigo-700 font-mono">nip</code>
                                <span class="text-sm text-gray-600">nomor induk pegawai</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-purple-50 border border-purple-100 rounded-2xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl select-none">🧑‍🎓</span>
                            <span class="font-bold text-purple-800">Siswa</span>
                        </div>
                        <p class="text-[11px] text-purple-500 font-bold uppercase tracking-widest mb-3">Data Khusus:</p>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-purple-200 px-2 py-0.5 rounded-md text-purple-700 font-mono">kelas</code>
                                <span class="text-sm text-gray-600">kelas yang diikuti</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <code class="text-xs bg-white border border-purple-200 px-2 py-0.5 rounded-md text-purple-700 font-mono">nis</code>
                                <span class="text-sm text-gray-600">nomor induk siswa</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Problem statement --}}
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-gray-400 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <span class="text-white font-black text-base leading-none">?</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Poin Masalah</p>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Bagaimana cara membuat sistem yang kodenya <strong>efisien</strong>
                            (tidak menulis ulang fitur login), tapi
                            <strong>password</strong> setiap pengguna tetap
                            <strong>aman</strong> dan tidak bisa dibobol dari luar?
                        </p>
                    </div>
                </div>

                {{-- Clue highlight box --}}
                <div class="bg-purple-600 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5 text-lg select-none">
                        💡
                    </div>
                    <div>
                        <p class="text-xs font-bold text-purple-100 uppercase tracking-wider mb-1.5">Clue</p>
                        <p class="text-white text-sm leading-relaxed">
                            Kita butuh <strong>efisiensi dari Inheritance</strong> untuk menghindari kode berulang,
                            dan <strong>keamanan mutlak dari Enkapsulasi</strong> untuk mengunci password
                            agar tidak bisa diakses dari luar class!
                        </p>
                    </div>
                </div>

                <p class="text-gray-400 italic text-sm">Pikirkan solusinya sebelum melanjutkan ke fase berikutnya.</p>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p3.fase2') }}"
                   class="btn-pulse-purple inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 2 – Pencetusan Ide
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 3 · FASE 2 — Pencetusan Ide: Proyek Akhir
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 3 && $fase == 2)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">💡</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Pencetusan Ide: Merakit Fondasi Ganda
                        </h3>
                        <p class="text-sm text-purple-600 font-medium">Dua senjata OOP dalam satu sistem</p>
                    </div>
                </div>

                <p class="text-gray-700 text-base leading-relaxed">
                    Untuk memecahkan masalah ini, kita tidak bisa hanya mengandalkan satu konsep.
                    Kita perlu <strong class="text-gray-900">dua alat OOP sekaligus</strong>, masing-masing punya peran berbeda:
                </p>

                {{-- Grid 2 kolom --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- Kiri: Enkapsulasi (Tameng Keamanan) --}}
                    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="text-2xl select-none">🛡️</span>
                            <span class="font-bold text-rose-800">Tameng Keamanan</span>
                        </div>
                        <p class="text-[11px] text-rose-500 font-bold uppercase tracking-widest">Enkapsulasi</p>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Gunakan <strong>Enkapsulasi</strong> untuk mengunci atribut
                            <code class="bg-rose-100 border border-rose-200 text-rose-700 font-mono text-xs px-1.5 py-0.5 rounded">__password</code>
                            di dalam brankas <span class="font-semibold text-rose-700">(private)</span>,
                            lalu buatkan pintu akses resmi berupa
                            <strong>Getter</strong> dan <strong>Setter</strong>.
                        </p>
                        <div class="bg-white border border-rose-100 rounded-xl px-4 py-3 font-mono text-xs text-gray-700 space-y-0.5 mt-auto">
                            <p><span class="text-gray-400"># dikunci rapat</span></p>
                            <p><span class="text-rose-600">self.__password</span> = <span class="text-orange-500">"****"</span></p>
                            <p class="mt-1"><span class="text-gray-400"># pintu resmi</span></p>
                            <p><span class="text-purple-600">def</span> <span class="text-blue-600">get_password</span>(self):</p>
                            <p class="ml-4">...</p>
                        </div>
                    </div>

                    {{-- Kanan: Inheritance (Pohon Silsilah) --}}
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="text-2xl select-none">🌳</span>
                            <span class="font-bold text-green-800">Pohon Silsilah</span>
                        </div>
                        <p class="text-[11px] text-green-500 font-bold uppercase tracking-widest">Inheritance</p>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Gunakan <strong>Inheritance</strong> dengan membuat class induk
                            <code class="bg-green-100 border border-green-200 text-green-700 font-mono text-xs px-1.5 py-0.5 rounded">AkunSekolah</code>,
                            lalu wariskan "brankas" tadi ke class anak
                            <code class="bg-green-100 border border-green-200 text-green-700 font-mono text-xs px-1.5 py-0.5 rounded">Guru</code>
                            dan
                            <code class="bg-green-100 border border-green-200 text-green-700 font-mono text-xs px-1.5 py-0.5 rounded">Siswa</code>.
                        </p>
                        <div class="flex flex-col items-center gap-1.5 mt-auto py-1">
                            <div class="w-full bg-white border-2 border-green-400 rounded-xl px-4 py-2 text-center">
                                <p class="font-mono text-xs font-bold text-green-700">AkunSekolah</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">nama, __password</p>
                            </div>
                            <div class="flex gap-6">
                                <div class="flex flex-col items-center"><div class="w-px h-4 bg-green-400"></div><svg class="w-2.5 h-2.5 text-green-500" viewBox="0 0 10 10" fill="currentColor"><path d="M5 10L0 3h10z"/></svg></div>
                                <div class="flex flex-col items-center"><div class="w-px h-4 bg-green-400"></div><svg class="w-2.5 h-2.5 text-green-500" viewBox="0 0 10 10" fill="currentColor"><path d="M5 10L0 3h10z"/></svg></div>
                            </div>
                            <div class="flex gap-3 w-full">
                                <div class="flex-1 bg-white border border-green-300 rounded-xl px-2 py-2 text-center">
                                    <p class="font-mono text-[11px] font-bold text-indigo-700">Guru</p>
                                    <p class="text-[9px] text-gray-400">+ mata_pelajaran</p>
                                </div>
                                <div class="flex-1 bg-white border border-green-300 rounded-xl px-2 py-2 text-center">
                                    <p class="font-mono text-[11px] font-bold text-purple-700">Siswa</p>
                                    <p class="text-[9px] text-gray-400">+ kelas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Kesimpulan --}}
                <div class="bg-purple-50 border border-purple-200 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Dengan menggabungkan keduanya, kita mendapat sistem yang
                        <strong class="text-purple-700">tidak membuang-buang kode</strong> (Inheritance)
                        sekaligus <strong class="text-rose-700">tidak bisa ditembus dari luar</strong> (Enkapsulasi).
                        Inilah fondasi sistem keamanan profesional.
                    </p>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p3.fase3') }}"
                   class="btn-pulse-purple inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 3 – Penstrukturan Ide
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 3 · FASE 3 — Penstrukturan Ide: Proyek Akhir
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 3 && $fase == 3)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🏗️</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Penstrukturan Ide: Aturan Gabungan OOP
                        </h3>
                        <p class="text-sm text-purple-600 font-medium">Enkapsulasi + Inheritance · Aturan krusial yang harus dipahami</p>
                    </div>
                </div>

                <p class="text-gray-700 text-base leading-relaxed">
                    Saat menggabungkan dua konsep ini, ada aturan penting yang
                    <strong class="text-gray-900">wajib kamu ingat</strong> agar sistem bekerja dengan benar:
                </p>

                {{-- Aturan cards --}}
                <div class="space-y-4">

                    {{-- Aturan 1 --}}
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-rose-700 font-black text-lg leading-none">1</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900">Private Tetap Private</span>
                                <span class="text-xs bg-rose-50 border border-rose-200 text-rose-600 font-semibold px-2 py-0.5 rounded-full">Aturan Enkapsulasi</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Meski diturunkan melalui Inheritance, class anak
                                <strong class="text-rose-700">tidak bisa langsung menyentuh</strong>
                                atribut <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">private</code>
                                milik class induk.
                                "Brankas" tetap terkunci rapat meski sudah diwariskan.
                            </p>
                            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-mono text-xs space-y-0.5">
                                <p class="text-purple-600 font-semibold">class Guru(AkunSekolah):</p>
                                <p class="ml-4 text-gray-400"># ❌ INI AKAN ERROR!</p>
                                <p class="ml-4"><span class="text-red-500">print(self.__password)</span>  <span class="text-gray-400"># tidak bisa diakses</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Aturan 2 --}}
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-green-700 font-black text-lg leading-none">2</span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-gray-900">Akses via Method Resmi</span>
                                <span class="text-xs bg-green-50 border border-green-200 text-green-600 font-semibold px-2 py-0.5 rounded-full">Solusi yang Benar</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Class anak <strong class="text-green-700">hanya bisa</strong> membaca atau mengubah
                                password induknya melalui method
                                <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">Getter</code>
                                dan
                                <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">Setter</code>
                                yang berstatus <strong>public</strong> — pintu resmi yang sudah disediakan class induk.
                            </p>
                            <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-mono text-xs space-y-0.5">
                                <p class="text-purple-600 font-semibold">class Guru(AkunSekolah):</p>
                                <p class="ml-4 text-gray-400"># ✅ CARA YANG BENAR</p>
                                <p class="ml-4"><span class="text-blue-600">pw</span> = <span class="text-green-600">self.get_password()</span>  <span class="text-gray-400"># lewat getter</span></p>
                                <p class="ml-4"><span class="text-green-600">self.set_password(</span><span class="text-orange-500">"baru123"</span><span class="text-green-600">)</span>  <span class="text-gray-400"># lewat setter</span></p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Highlight box --}}
                <div class="bg-purple-600 rounded-2xl p-5 flex gap-4">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-purple-100 uppercase tracking-wider mb-1.5">Inti dari Gabungan Ini</p>
                        <p class="text-white text-sm leading-relaxed">
                            Inheritance membuat struktur class lebih <strong>efisien dan logis</strong>,
                            sementara Enkapsulasi menjamin bahwa data sensitif tetap
                            <strong>terlindungi</strong> — bahkan dari class-class turunannya sendiri.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <a href="{{ route('p3.fase4') }}"
                   class="btn-pulse-purple inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                    Selanjutnya: Fase 4 – Aplikasi
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 PERTEMUAN 3 · FASE 5 — Refleksi: Proyek Akhir
            ═══════════════════════════════════════════════════════════ --}}
            @elseif($pertemuan == 3 && $fase == 5)

            <div class="space-y-8 pb-20" data-aos="fade-up" data-aos-duration="550">

                {{-- Section title --}}
                <div class="flex items-start gap-4">
                    <div class="text-4xl leading-none mt-0.5 select-none">🏆</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            Refleksi: Kamu Sudah Menjadi Programmer PBO!
                        </h3>
                        <p class="text-sm text-purple-600 font-medium">Evaluasi akhir · Pencapaianmu selama ini</p>
                    </div>
                </div>

                {{-- Ucapan selamat --}}
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 rounded-2xl p-6 text-center">
                    <p class="text-4xl mb-3 select-none">🎉</p>
                    <p class="text-lg font-bold text-gray-900 mb-2">Selamat, kamu telah menyelesaikan semua materi!</p>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-md mx-auto">
                        Kamu berhasil mempelajari dan mempraktikkan dua pilar utama OOP —
                        Enkapsulasi dan Inheritance — lalu menggabungkannya dalam satu proyek nyata.
                    </p>
                </div>

                {{-- Checklist keberhasilan --}}
                <div class="space-y-3">

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">
                                Mampu mengamankan data rahasia
                                <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Enkapsulasi</span>
                            </p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Kamu tahu cara mengunci atribut dengan
                                <code class="bg-gray-100 text-gray-700 font-mono text-xs px-1 rounded">private</code>
                                dan membuat akses terkontrol lewat Getter & Setter.
                                Password tidak bisa dibobol sembarangan.
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">
                                Mampu mendesain hierarki class yang efisien
                                <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Inheritance</span>
                            </p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Kamu bisa membuat class induk yang mewariskan properti ke banyak class anak,
                                menghindari penulisan kode yang berulang.
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex gap-4">
                        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 mb-1">
                                Mampu menggabungkan keduanya dalam sistem nyata
                                <span class="font-mono text-xs bg-green-100 border border-green-300 px-1.5 py-0.5 rounded text-green-700">Proyek Akhir</span>
                            </p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Kamu merancang sistem akun sekolah yang efisien sekaligus aman —
                                bukti nyata bahwa kamu sudah berpikir seperti programmer profesional.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Penutup --}}
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 text-center">
                    <p class="text-gray-700 font-semibold mb-1">Semua materi Pemrograman Berorientasi Objek selesai!</p>
                    <p class="text-gray-500 text-sm">Kembali ke dashboard untuk melihat progres belajarmu.</p>
                </div>

            </div>

            {{-- Navigation --}}
            <div class="absolute bottom-8 right-8">
                <form method="POST" action="{{ route('p3.fase5.complete') }}">
                    @csrf
                    <button type="submit"
                            class="btn-pulse-purple inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Selesai · Kembali ke Dashboard
                    </button>
                </form>
            </div>

            {{-- ═══════════════════════════════════════════════════════════
                 SEMUA HALAMAN LAIN — placeholder "Segera Hadir"
            ═══════════════════════════════════════════════════════════ --}}
            @else

            <div class="flex flex-col items-center justify-center py-16 text-center">

                @if($warna === 'blue')
                <div class="w-24 h-24 rounded-3xl bg-blue-50 flex items-center justify-center mb-8 shadow-sm">
                    <svg class="w-12 h-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>
                    </svg>
                </div>
                @else
                <div class="w-24 h-24 rounded-3xl bg-purple-50 flex items-center justify-center mb-8 shadow-sm">
                    <svg class="w-12 h-12 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
                    </svg>
                </div>
                @endif

                <h3 class="text-xl font-bold text-gray-700 mb-3">Konten Segera Hadir</h3>
                <p class="text-gray-500 text-sm max-w-md leading-relaxed mb-2">
                    Materi untuk <strong>Pertemuan {{ $pertemuan }}</strong> ·
                    <strong>Fase {{ $fase }} — {{ $faseNama }}</strong>
                    sedang dalam tahap pengembangan.
                </p>
                <p class="text-gray-400 text-xs mb-8">
                    Topik: <span class="font-semibold" style="color:{{ $warnaHex }};">{{ $topikNama }}</span>
                    · Model Needham Lima Fase
                </p>

                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 max-w-md text-left space-y-3 mb-8">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">
                        Yang akan dipelajari di fase ini:
                    </p>
                    @php
                    $descriptions = [
                        1 => [
                            'Mengenal konsep ' . $topikNama . ' dalam OOP',
                            'Identifikasi permasalahan dalam kode',
                            'Memahami mengapa ' . $topikNama . ' diperlukan',
                        ],
                        2 => [
                            'Eksplorasi ide tentang ' . $topikNama,
                            'Quiz interaktif untuk mengukur pemahaman awal',
                            'Menghubungkan konsep dengan dunia nyata',
                        ],
                        3 => [
                            'Menyusun struktur kode ' . $topikNama,
                            'Block programming untuk ' . $topikNama,
                            'Membangun pemahaman yang terstruktur',
                        ],
                        4 => [
                            'Menulis kode ' . $topikNama . ' dengan Blockly',
                            'Praktik implementasi dalam konteks nyata',
                            'Uji coba dan debug kode',
                        ],
                        5 => [
                            'Refleksi pemahaman tentang ' . $topikNama,
                            'Evaluasi hasil pembelajaran',
                            'Menjawab pertanyaan reflektif',
                        ],
                    ];
                    @endphp
                    @foreach($descriptions[$fase] as $point)
                    <div class="flex items-start gap-2.5">
                        <span class="w-4 h-4 rounded-full flex-shrink-0 flex items-center justify-center mt-0.5"
                              style="background:{{ $warnaHex }}1a;">
                            <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="{{ $warnaHex }}" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                        <span class="text-sm text-gray-600">{{ $point }}</span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('dashboard.siswa') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            @endif

        </div>
        </div>
    </main>

</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once: true, duration: 550, offset: 20 });</script>
</body>
</html>
