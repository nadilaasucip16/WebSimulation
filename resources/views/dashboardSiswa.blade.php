<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – OOP Learn</title>
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

    <main class="flex-1 flex flex-col overflow-hidden min-w-0">

        @include('_navbar', ['navTitle' => 'Dashboard'])

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

            {{-- Welcome Header --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-500 font-medium mb-1">Selamat datang kembali</p>
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-900 leading-tight">
                            {{ auth()->user()->name ?? 'Siswa' }}
                        </h2>
                        <p class="text-gray-500 text-sm mt-1.5 leading-relaxed">
                            Teruslah belajar dan tingkatkan pemahamanmu tentang
                            <span class="font-medium text-gray-700">Pemrograman Berorientasi Objek</span>.
                        </p>
                    </div>
                    <div class="shrink-0 text-center px-6 py-3 bg-gray-50 rounded-lg border border-gray-200 min-w-[7rem]">
                        <p class="text-xs text-gray-500 font-medium mb-1">Progress</p>
                        <p class="text-3xl font-black text-gray-900 leading-none">{{ $progressPct }}%</p>
                        <p class="text-[11px] text-gray-400 mt-1">{{ $totalDone }} / 15 Fase</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1.5">
                        <span>Progress Pembelajaran (3 Pertemuan)</span>
                        <span class="font-semibold text-gray-700">{{ $progressPct }}%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full transition-all duration-500"
                             style="width: {{ $progressPct }}%"></div>
                    </div>
                </div>

                <div class="mt-4">
                    @if($totalDone >= 15)
                        <a href="{{ route('grade') }}"
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition">
                            Lihat Hasil Belajar →
                        </a>
                    @elseif($totalDone === 0)
                        <a href="{{ route('fase1') }}"
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition">
                            Mulai Belajar →
                        </a>
                    @else
                        @php
                            if (!$p2Unlocked) {
                                $lanjutRoute = route('fase' . ($p1Done + 1));
                                $lanjutLabel = 'Lanjutkan Pertemuan 1 · Fase ' . ($p1Done + 1);
                            } elseif (!$p3Unlocked) {
                                $lanjutRoute = route('p2.fase' . ($p2Done + 1));
                                $lanjutLabel = 'Lanjutkan Pertemuan 2 · Fase ' . ($p2Done + 1);
                            } else {
                                $lanjutRoute = route('p3.fase' . ($p3Done + 1));
                                $lanjutLabel = 'Lanjutkan Pertemuan 3 · Fase ' . ($p3Done + 1);
                            }
                        @endphp
                        <a href="{{ $lanjutRoute }}"
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg transition">
                            {{ $lanjutLabel }} →
                        </a>
                    @endif
                </div>
            </div>

            {{-- Tahapan Pembelajaran --}}
            <div class="mb-6" x-data="{ tab: {{ !$p2Unlocked ? 1 : (!$p3Unlocked ? 2 : 3) }} }">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-gray-800">Tahapan Pembelajaran</h3>
                </div>

                {{-- Tab Buttons --}}
                <div class="flex gap-2 mb-4 flex-wrap">

                    <button @click="tab = 1"
                            :class="tab === 1
                                ? 'bg-green-600 text-white border-green-600'
                                : 'bg-white text-gray-600 border-gray-200 hover:border-green-300'"
                            class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg border transition">
                        @if($p1Done >= 5)
                            <span class="text-[10px]">✓</span>
                        @endif
                        Pertemuan 1
                        <span class="text-[10px] font-normal opacity-75">Enkapsulasi</span>
                        <span class="text-[10px] font-bold opacity-75">{{ $p1Done }}/5</span>
                    </button>

                    <button @click="tab = 2"
                            :disabled="{{ !$p2Unlocked ? 'true' : 'false' }}"
                            :class="tab === 2
                                ? 'bg-blue-600 text-white border-blue-600'
                                : ({{ $p2Unlocked ? 'true' : 'false' }}
                                    ? 'bg-white text-gray-600 border-gray-200 hover:border-blue-300'
                                    : 'bg-gray-50 text-gray-300 border-gray-100 cursor-not-allowed')"
                            class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg border transition">
                        @if(!$p2Unlocked)
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        @elseif($p2Done >= 5)
                            <span class="text-[10px]">✓</span>
                        @endif
                        Pertemuan 2
                        <span class="text-[10px] font-normal opacity-75">Inheritance</span>
                        @if($p2Unlocked)
                        <span class="text-[10px] font-bold opacity-75">{{ $p2Done }}/5</span>
                        @endif
                    </button>

                    <button @click="tab = 3"
                            :disabled="{{ !$p3Unlocked ? 'true' : 'false' }}"
                            :class="tab === 3
                                ? 'bg-purple-600 text-white border-purple-600'
                                : ({{ $p3Unlocked ? 'true' : 'false' }}
                                    ? 'bg-white text-gray-600 border-gray-200 hover:border-purple-300'
                                    : 'bg-gray-50 text-gray-300 border-gray-100 cursor-not-allowed')"
                            class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg border transition">
                        @if(!$p3Unlocked)
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        @elseif($p3Done >= 5)
                            <span class="text-[10px]">✓</span>
                        @endif
                        Pertemuan 3
                        <span class="text-[10px] font-normal opacity-75">Proyek Akhir</span>
                        @if($p3Unlocked)
                        <span class="text-[10px] font-bold opacity-75">{{ $p3Done }}/5</span>
                        @endif
                    </button>

                </div>

                {{-- Pertemuan 1 --}}
                @php
                $p1Phases = [
                    ['num'=>1,'title'=>'Orientasi',        'desc'=>'Identifikasi konsep awal OOP',    'route'=>'fase1'],
                    ['num'=>2,'title'=>'Pencetusan Ide',   'desc'=>'Eksplorasi konsep baru',           'route'=>'fase2'],
                    ['num'=>3,'title'=>'Penstrukturan',    'desc'=>'Menyusun pemahaman OOP',           'route'=>'fase3'],
                    ['num'=>4,'title'=>'Aplikasi Ide',     'desc'=>'Terapkan dalam latihan ICS',       'route'=>'fase4'],
                    ['num'=>5,'title'=>'Refleksi',         'desc'=>'Evaluasi pembelajaran',            'route'=>'fase5'],
                ];
                @endphp
                <div x-show="tab === 1" x-cloak>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                        @foreach($p1Phases as $phase)
                        @php
                            $done     = $phase['num'] <= $p1Done;
                            $isActive = $phase['num'] === $p1Done + 1;
                            $isLocked = $phase['num'] >  $p1Done + 1;
                            $accent   = 'green';
                        @endphp
                        @include('_dashboard-phase-card', compact('phase','done','isActive','isLocked','accent'))
                        @endforeach
                    </div>
                </div>

                {{-- Pertemuan 2 --}}
                @php
                $p2Phases = [
                    ['num'=>1,'title'=>'Orientasi',        'desc'=>'Studi kasus karakter Gim RPG',     'route'=>'p2.fase1'],
                    ['num'=>2,'title'=>'Pencetusan Ide',   'desc'=>'Menemukan solusi yang efisien',    'route'=>'p2.fase2'],
                    ['num'=>3,'title'=>'Penstrukturan',    'desc'=>'Konsep & terminologi Inheritance', 'route'=>'p2.fase3'],
                    ['num'=>4,'title'=>'Aplikasi Ide',     'desc'=>'Praktik Blueprint Builder',        'route'=>'p2.fase4'],
                    ['num'=>5,'title'=>'Refleksi',         'desc'=>'Evaluasi pembelajaran',            'route'=>'p2.fase5'],
                ];
                @endphp
                <div x-show="tab === 2" x-cloak>
                    @if(!$p2Unlocked)
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-sm font-medium mb-1">Pertemuan 2 Terkunci</p>
                        <p class="text-xs">Selesaikan Pertemuan 1 Fase 5 terlebih dahulu.</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                        @foreach($p2Phases as $phase)
                        @php
                            $done     = $phase['num'] <= $p2Done;
                            $isActive = $phase['num'] === $p2Done + 1;
                            $isLocked = $phase['num'] >  $p2Done + 1;
                            $accent   = 'blue';
                        @endphp
                        @include('_dashboard-phase-card', compact('phase','done','isActive','isLocked','accent'))
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Pertemuan 3 --}}
                @php
                $p3Phases = [
                    ['num'=>1,'title'=>'Orientasi',        'desc'=>'Sistem Manajemen Akun Sekolah',   'route'=>'p3.fase1'],
                    ['num'=>2,'title'=>'Pencetusan Ide',   'desc'=>'Merakit fondasi ganda OOP',       'route'=>'p3.fase2'],
                    ['num'=>3,'title'=>'Penstrukturan',    'desc'=>'Aturan gabungan Enk+Inh',         'route'=>'p3.fase3'],
                    ['num'=>4,'title'=>'Aplikasi Ide',     'desc'=>'Proyek Blueprint Builder',        'route'=>'p3.fase4'],
                    ['num'=>5,'title'=>'Refleksi',         'desc'=>'Evaluasi akhir',                  'route'=>'p3.fase5'],
                ];
                @endphp
                <div x-show="tab === 3" x-cloak>
                    @if(!$p3Unlocked)
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-sm font-medium mb-1">Pertemuan 3 Terkunci</p>
                        <p class="text-xs">Selesaikan Pertemuan 2 Fase 5 terlebih dahulu.</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                        @foreach($p3Phases as $phase)
                        @php
                            $done     = $phase['num'] <= $p3Done;
                            $isActive = $phase['num'] === $p3Done + 1;
                            $isLocked = $phase['num'] >  $p3Done + 1;
                            $accent   = 'purple';
                        @endphp
                        @include('_dashboard-phase-card', compact('phase','done','isActive','isLocked','accent'))
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <a href="{{ route('assessment') }}"
                   class="bg-white rounded-xl border border-gray-200 px-4 py-3.5 flex items-center justify-between hover:border-gray-300 transition group">
                    <div>
                        <p class="text-xs text-gray-500">Tes Kemampuan</p>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5">Assessment</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('lesson') }}"
                   class="bg-white rounded-xl border border-gray-200 px-4 py-3.5 flex items-center justify-between hover:border-gray-300 transition group">
                    <div>
                        <p class="text-xs text-gray-500">Pelajari Materi</p>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5">Materi OOP</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('grade') }}"
                   class="bg-white rounded-xl border border-gray-200 px-4 py-3.5 flex items-center justify-between hover:border-gray-300 transition group">
                    <div>
                        <p class="text-xs text-gray-500">Pantau Nilaimu</p>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5">Hasil Belajar</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </main>
</div>

</body>
</html>
