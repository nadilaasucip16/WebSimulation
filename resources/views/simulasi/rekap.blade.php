<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Simulasi - OOP Learn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>

<body class="bg-gray-50 min-h-screen">

    {{-- Header --}}
    <header class="bg-white border-b border-gray-100 h-14 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.guru') }}"
               class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-sm font-bold text-gray-900">Rekap Simulasi Siswa</p>
                <p class="text-[10px] text-gray-400 leading-none">Data hasil simulasi interaktif OOP</p>
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-gray-400">Guru</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=e0e7ff&color=4338ca&size=32"
                 class="w-8 h-8 rounded-full border border-gray-100" alt="avatar">
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Stat summary --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Total Simulasi Selesai</p>
                <p class="text-3xl font-bold text-gray-900">{{ $hasil->total() }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Rata-rata Durasi</p>
                @php
                    $avgDurasi = $hasil->avg('durasi_detik');
                    $menit = floor($avgDurasi / 60);
                    $detik = $avgDurasi % 60;
                @endphp
                <p class="text-3xl font-bold text-gray-900">{{ $menit }}<span class="text-lg font-medium text-gray-400">m {{ $detik }}d</span></p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Rata-rata Langkah</p>
                <p class="text-3xl font-bold text-gray-900">{{ round($hasil->avg('jumlah_step'), 1) }}</p>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-800">Data Hasil Simulasi</h2>
                <span class="text-xs text-gray-400">{{ $hasil->total() }} data</span>
            </div>

            @if($hasil->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <p class="text-sm font-medium">Belum ada data simulasi</p>
                <p class="text-xs mt-1">Data akan muncul setelah siswa menyelesaikan simulasi</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-3">Siswa</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Skenario</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3 hidden md:table-cell">Refleksi</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3 hidden lg:table-cell">Langkah</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3 hidden lg:table-cell">Durasi</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($hasil as $h)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($h->nama_siswa ?? 'S') }}&background=dcfce7&color=166534&size=28"
                                         class="w-7 h-7 rounded-full shrink-0" alt="">
                                    <div>
                                        <p class="font-semibold text-gray-800 text-xs">{{ $h->nama_siswa ?? '-' }}</p>
                                        <p class="text-[10px] text-gray-400 font-mono">{{ $h->token }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                @if($h->skenario)
                                    <span class="text-xs font-medium text-gray-700">{{ $h->skenario->judul }}</span>
                                    <span class="ml-1.5 text-[10px] px-1.5 py-0.5 rounded-full
                                        {{ $h->skenario->materi === 'enkapsulasi' ? 'bg-green-50 text-green-700' : 'bg-blue-50 text-blue-700' }}">
                                        {{ $h->skenario->materi }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Skenario default</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell max-w-xs">
                                <p class="text-xs text-gray-500 truncate">{{ $h->refleksi ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-4 text-center hidden lg:table-cell">
                                <span class="text-xs font-semibold text-gray-700">{{ $h->jumlah_step ?? 0 }}</span>
                            </td>
                            <td class="px-4 py-4 text-center hidden lg:table-cell">
                                @php
                                    $d = $h->durasi_detik ?? 0;
                                    $m = floor($d / 60); $s = $d % 60;
                                @endphp
                                <span class="text-xs text-gray-600">{{ $m }}m {{ $s }}d</span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="text-xs text-gray-500">
                                    {{ $h->selesai_at ? $h->selesai_at->format('d/m/y H:i') : '-' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($hasil->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $hasil->links() }}
            </div>
            @endif

            @endif
        </div>

    </div>

</body>
</html>
