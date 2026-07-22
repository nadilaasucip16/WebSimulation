<header class="bg-white border-b border-gray-100 h-14 px-4 sm:px-6 flex items-center justify-between shrink-0">

    {{-- Kiri: toggle + judul --}}
    <div class="flex items-center gap-3 min-w-0">
        <button @click="$dispatch('toggle-sidebar')"
                class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 active:scale-95 transition shrink-0">
            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="font-semibold text-gray-800 text-sm truncate">{{ $navTitle ?? 'Dashboard' }}</h1>
    </div>

    {{-- Kanan: nama user + avatar --}}
    <div class="flex items-center gap-2.5 shrink-0">
        <div class="text-right hidden sm:block">
            <p class="text-gray-800 font-semibold text-xs leading-none">{{ auth()->user()->name ?? 'Pengguna' }}</p>
            <p class="text-gray-400 text-[10px] leading-none mt-0.5">{{ auth()->user()->role ?? 'siswa' }}</p>
        </div>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'U') }}&background=dcfce7&color=166534&size=32"
             class="w-8 h-8 rounded-full shrink-0 border border-gray-100" alt="avatar">
    </div>

</header>
