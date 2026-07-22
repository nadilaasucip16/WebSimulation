<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posttest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

    @include('sidebar-siswa')

    <main class="flex-1 p-8" x-data="cbtApp()" x-init="startTimer()">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">

            <div class="bg-[#3d943d] text-white px-6 py-2 rounded-xl font-bold text-lg flex items-center gap-3">
                <span class="tracking-widest uppercase">Posttest</span>
            </div>

            <div class="flex items-center gap-4">
                <!-- Timer -->
                <div class="flex items-center gap-2 bg-white border border-gray-200 px-5 py-2 rounded-xl shadow-sm">
                    <span>⏱</span>
                    <span class="font-black text-xl tabular-nums"
                          :class="minutes === 0 && seconds <= 59 ? 'text-red-500 animate-pulse' : 'text-gray-800'"
                          x-text="String(minutes).padStart(2,'0') + ':' + String(seconds).padStart(2,'0')">
                    </span>
                </div>
                <!-- Profil -->
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Siswa') }}&background=3d943d&color=fff"
                         class="w-10 h-10 rounded-full border-2 border-white shadow">
                    <span class="font-bold text-gray-800 hidden md:block">{{ auth()->user()->name ?? 'Siswa' }}</span>
                </div>
            </div>

        </div>

        <!-- PROGRESS BAR -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="font-semibold text-gray-600 text-sm">
                    Soal <span x-text="current + 1" class="text-[#3d943d] font-black text-base"></span>
                    dari <span x-text="questions.length" class="font-black text-base"></span>
                </span>
                <span class="font-bold text-sm text-[#3d943d]">
                    <span x-text="answered()"></span> / <span x-text="questions.length"></span> terjawab
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div class="bg-[#3d943d] h-3 rounded-full transition-all duration-500"
                     :style="'width:' + ((current + 1) / questions.length * 100) + '%'">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">

            <!-- SOAL -->
            <div class="col-span-9">

                <form id="cbtForm" method="POST" action="{{ route('submit.posttest') }}">
                    @csrf

                    <!-- Hidden answers -->
                    <template x-for="(ans, idx) in answers" :key="idx">
                        <input type="hidden" :name="'q' + (idx + 1)" :value="ans">
                    </template>

                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-10">

                        <!-- Badge nomor soal -->
                        <div class="flex items-center gap-3 mb-6">
                            <span class="bg-[#3d943d] text-white w-10 h-10 rounded-xl flex items-center justify-center font-black text-lg"
                                  x-text="current + 1">
                            </span>
                            <span class="text-gray-400 font-semibold text-xs uppercase tracking-widest">Pertanyaan</span>
                        </div>

                        <!-- Teks soal -->
                        <h2 class="text-2xl font-bold mb-8" x-text="questions[current].question"></h2>

                        <!-- Pilihan jawaban -->
                        <div class="space-y-3">
                            <template x-for="(opt, oi) in questions[current].options" :key="oi">
                                <label class="flex items-center gap-4 border-2 rounded-xl p-4 cursor-pointer transition-all duration-150 select-none"
                                       :class="answers[current] === keys[oi]
                                           ? 'border-[#3d943d] bg-[#eef7ee]'
                                           : 'border-gray-200 hover:border-green-300 hover:bg-gray-50'">

                                    <input type="radio" class="hidden"
                                           :name="'visual_q' + current"
                                           :value="keys[oi]"
                                           x-model="answers[current]">

                                    <span class="w-9 h-9 flex-shrink-0 rounded-lg border-2 flex items-center justify-center font-black text-sm transition-all"
                                          :class="answers[current] === keys[oi]
                                              ? 'border-[#3d943d] bg-[#3d943d] text-white'
                                              : 'border-gray-300 text-gray-500'"
                                          x-text="keys[oi]">
                                    </span>

                                    <span class="font-medium text-gray-800" x-text="opt"></span>
                                </label>
                            </template>
                        </div>

                        <!-- Navigasi soal -->
                        <div class="flex justify-between items-center mt-10 pt-6 border-t border-gray-100">

                            <button type="button" @click="prev()"
                                    x-show="current > 0"
                                    class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-xl transition">
                                ← Sebelumnya
                            </button>
                            <div x-show="current === 0"></div>

                            <button type="button" @click="next()"
                                    x-show="current < questions.length - 1"
                                    class="flex items-center gap-2 bg-[#3d943d] hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl transition">
                                Selanjutnya →
                            </button>

                            <button type="button" @click="submitForm()"
                                    x-show="current === questions.length - 1"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-black px-8 py-3 rounded-xl transition shadow-md">
                                Selesai & Kirim ✓
                            </button>

                        </div>

                    </div>
                </form>

            </div>

            <!-- NAVIGATOR -->
            <div class="col-span-3">

                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 sticky top-6">

                    <h3 class="font-black text-gray-700 mb-4 text-sm uppercase tracking-widest">Navigasi Soal</h3>

                    <div class="grid grid-cols-4 gap-2 mb-5">
                        <template x-for="(q, i) in questions" :key="i">
                            <button type="button" @click="current = i"
                                    class="w-10 h-10 rounded-xl font-bold text-sm transition-all duration-150"
                                    :class="current === i
                                        ? 'bg-[#3d943d] text-white shadow-md scale-110'
                                        : answers[i]
                                            ? 'bg-green-100 text-green-700 border-2 border-green-300'
                                            : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                                    x-text="i + 1">
                            </button>
                        </template>
                    </div>

                    <div class="space-y-2 text-xs text-gray-500 border-t border-gray-100 pt-4">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-lg bg-[#3d943d]"></div>
                            <span>Sedang dikerjakan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-lg bg-green-100 border-2 border-green-300"></div>
                            <span>Sudah dijawab</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-lg bg-gray-100"></div>
                            <span>Belum dijawab</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<script>
function cbtApp() {
    return {
        current: 0,
        answers: Array({{ $questions->count() }}).fill(''),
        minutes: {{ $timeLimit }},
        seconds: 0,
        keys: ['A', 'B', 'C', 'D'],

        questions: {{ Js::from($questions->map(fn($q) => ['question' => $q->question, 'options' => [$q->option_a, $q->option_b, $q->option_c, $q->option_d]])->values()) }},

        answered() {
            return this.answers.filter(a => a !== '').length;
        },

        prev() {
            if (this.current > 0) this.current--;
        },

        next() {
            if (this.current < this.questions.length - 1) this.current++;
        },

        submitForm() {
            const sisa = this.questions.length - this.answered();
            if (sisa > 0) {
                if (!confirm(`Masih ada ${sisa} soal yang belum dijawab. Tetap kirim?`)) return;
            }
            document.getElementById('cbtForm').submit();
        },

        startTimer() {
            setInterval(() => {
                if (this.seconds === 0) {
                    if (this.minutes === 0) {
                        document.getElementById('cbtForm').submit();
                        return;
                    }
                    this.minutes--;
                    this.seconds = 59;
                } else {
                    this.seconds--;
                }
            }, 1000);
        },
    };
}
</script>

</body>
</html>
