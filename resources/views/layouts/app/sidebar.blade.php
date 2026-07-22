<aside
    :class="sidebarOpen ? 'w-72' : 'w-20'"
    class="bg-[#f8faf7] border-r border-gray-200 p-6 flex flex-col shrink-0 transition-all duration-300">

    <div class="flex items-center justify-between mb-8">
        <div x-show="sidebarOpen" x-transition>
            <h2 class="font-bold text-2xl text-[#3d943d]">
                OOP Learn
            </h2>
            <p class="text-sm text-gray-500">
                Media Pembelajaran
            </p>
        </div>

        <button
            @click="sidebarOpen = !sidebarOpen"
            class="text-gray-600 hover:bg-gray-200 p-2 rounded-lg transition">
            笘ｰ
        </button>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('dashboard.siswa') }}"
           class="flex items-center gap-4 px-4 py-3 bg-[#dce9d5] text-[#3d943d] font-bold rounded-2xl transition hover:bg-[#dce9d5]">
            <span class="text-xl">匠</span>
            <span x-show="sidebarOpen" x-transition>Dashboard</span>
        </a>

        <a href="{{ route('pretest') }}"
           class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl transition">
            <span class="text-xl">統</span>
            <span x-show="sidebarOpen" x-transition>Assessment</span>
        </a>

        <a href="{{ route('lesson') }}"
           class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl transition">
            <span class="text-xl">答</span>
            <span x-show="sidebarOpen" x-transition>Lesson</span>
        </a>

        <details class="group">
            <summary
                class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl cursor-pointer">
                <span class="text-xl">笞｡</span>
                <span x-show="sidebarOpen" x-transition>Activity</span>
            </summary>

            <div x-show="sidebarOpen" class="ml-10 mt-2 flex flex-col gap-2">
                <a href="{{ route('fase1') }}" class="text-sm text-gray-600 hover:text-[#3d943d] py-1 px-2 rounded-lg hover:bg-gray-100">
                    Fase 1 - Orientasi
                </a>
                <a href="{{ route('fase2') }}" class="text-sm text-gray-600 hover:text-[#3d943d] py-1 px-2 rounded-lg hover:bg-gray-100">
                    Fase 2 - Pencetusan Ide
                </a>
                <a href="{{ route('fase3') }}" class="text-sm text-gray-600 hover:text-[#3d943d] py-1 px-2 rounded-lg hover:bg-gray-100">
                    Fase 3 - Penstrukturan Ide
                </a>
                <a href="{{ route('fase4') }}" class="text-sm text-gray-600 hover:text-[#3d943d] py-1 px-2 rounded-lg hover:bg-gray-100">
                    Fase 4 - Aplikasi
                </a>
                <a href="{{ route('fase5') }}" class="text-sm text-gray-600 hover:text-[#3d943d] py-1 px-2 rounded-lg hover:bg-gray-100">
                    Fase 5 - Refleksi
                </a>
            </div>
        </details>

        <a href="#"
           class="flex items-center gap-4 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl transition">
            <span class="text-xl">側</span>
            <span x-show="sidebarOpen" x-transition>Akun</span>
        </a>
    </nav>
</aside>
