<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fase 2 - Pencetusan Ide</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }

        .option-card { transition: all 0.25s ease; }
        .option-card:hover { transform: translateY(-3px); }
        .option-card.active { background-color: #5eb15e; color: white; border-color: #5eb15e; }

        @keyframes ring-out {
            0%, 100% { box-shadow: 0 0 0 0 rgba(22,163,74,0.45); }
            60%       { box-shadow: 0 0 0 11px transparent; }
        }
        .btn-pulse { animation: ring-out 2s ease-in-out infinite; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

        @include('sidebar-siswa')
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">

            @include('_navbar', ['navTitle' => 'Fase 2 – Pencetusan Ide'])
            <div class="flex-1 overflow-y-auto p-8">

            <!-- Content Card -->
            <div id="quiz-box"
                class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-10 min-h-[80vh] relative">

                {{-- Phase badge --}}
                <div class="flex items-center gap-3 mb-5">
                    <span class="inline-flex items-center gap-1.5 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Fase 2 dari 5
                    </span>
                    <span class="text-xs text-gray-400 font-medium">Model Needham Lima Fase</span>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-1">Pencetusan Ide</h2>
                <p class="text-sm text-gray-500 mb-5">Permasalahan Keamanan Data</p>

                @include('_needham-stepper', ['currentFase' => 2])

                {{-- Tujuan Pembelajaran --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 mb-6 flex gap-4">
                    <div class="shrink-0 w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-blue-700 mb-2">Tujuan Pembelajaran</p>
                        <ul class="space-y-1 text-sm text-blue-900">
                            <li class="flex gap-2"><span class="text-blue-400 font-bold shrink-0">✓</span> Mengungkapkan pengetahuan awal tentang cara melindungi data dalam program</li>
                            <li class="flex gap-2"><span class="text-blue-400 font-bold shrink-0">✓</span> Menganalisis perbedaan akses publik dan akses terkontrol pada atribut class</li>
                        </ul>
                    </div>
                </div>

                <!-- QUESTION -->
                <div class="mb-8" data-aos="fade-up">

                    <p class="text-gray-500 font-semibold mb-4">
                        Pertanyaan
                        <span id="question-number">1</span> / 4
                    </p>

                    <h1 id="question-title"
                        class="text-4xl font-extrabold leading-tight max-w-4xl">

                        Bagaimana cara kita melindungi barang berharga di dunia nyata?
                    </h1>

                </div>

                <!-- OPTIONS -->
                <div id="options-container"
                    class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                </div>

                <!-- FEEDBACK -->
                <div id="feedback-box"
                    class="hidden rounded-2xl p-5 text-lg leading-relaxed mb-10">
                </div>

                <!-- Navigation Button -->
                <div class="absolute bottom-8 right-8">
                    <button id="next-btn" disabled
                        class="inline-flex items-center gap-2 bg-gray-300 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition">
                        Lanjut
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>

            </div>

            </div>
        </main>

    </div>

    <script>

        const questions = [

            {
                question: "Bagaimana cara kita melindungi barang berharga di dunia nyata?",

                options: [
                    "Brankas",
                    "Dompet",
                    "Gembok",
                    "Lainnya"
                ],

                correct: ["Brankas", "Gembok"],

                correctFeedback:
                    "✅ Benar! Barang berharga biasanya dilindungi menggunakan alat keamanan tertentu.",

                wrongFeedback:
                    "⚠️ Kurang tepat. Coba pikirkan kembali alat yang benar-benar digunakan untuk keamanan."
            },

            {
                question: "Kalau data pribadi di internet bocor, apa yang mungkin terjadi?",

                options: [
                    "Akun diretas",
                    "Data dicuri",
                    "Privasi terganggu",
                    "Semua benar"
                ],

                correct: ["Semua benar"],

                correctFeedback:
                    "✅ Tepat! Kebocoran data dapat menyebabkan akun diretas, data dicuri, dan privasi terganggu.",

                wrongFeedback:
                    "⚠️ Kurang tepat. Kebocoran data bisa menyebabkan banyak masalah."
            },

            {
                question: "Manakah yang termasuk data pribadi?",

                options: [
                    "Password",
                    "Nomor telepon",
                    "Alamat rumah",
                    "Semua benar"
                ],

                correct: ["Semua benar"],

                correctFeedback:
                    "✅ Benar! Semua informasi tersebut termasuk data pribadi.",

                wrongFeedback:
                    "⚠️ Kurang tepat. Data pribadi mencakup informasi penting seseorang."
            },

            {
                question: "Apa yang sebaiknya dilakukan agar akun tetap aman?",

                options: [
                    "Menggunakan password kuat",
                    "Membagikan password",
                    "Menggunakan password sama",
                    "Menulis password di media sosial"
                ],

                correct: ["Menggunakan password kuat"],

                correctFeedback:
                    "✅ Benar! Password kuat membantu melindungi akun.",

                wrongFeedback:
                    "⚠️ Kurang tepat. Password harus dijaga dan dibuat kuat."
            }

        ];

        let currentQuestion = 0;

        const questionTitle = document.getElementById('question-title');

        const optionsContainer = document.getElementById('options-container');

        const feedbackBox = document.getElementById('feedback-box');

        const nextBtn = document.getElementById('next-btn');

        const questionNumber = document.getElementById('question-number');

        const quizBox = document.getElementById('quiz-box');

        function loadQuestion() {

            const q = questions[currentQuestion];

            questionTitle.innerText = q.question;

            questionNumber.innerText = currentQuestion + 1;

            optionsContainer.innerHTML = "";

            feedbackBox.classList.add('hidden');

            nextBtn.disabled = true;

            nextBtn.className =
                "bg-gray-300 text-white px-10 py-4 rounded-xl font-bold text-xl flex items-center gap-3 transition-all";

            q.options.forEach(option => {

                const card = document.createElement('button');

                card.className =
                    "option-card border border-gray-200 rounded-2xl h-40 text-2xl font-bold bg-white hover:bg-[#eef6ea]";

                card.innerText = option;

                card.onclick = () => selectAnswer(card, option);

                optionsContainer.appendChild(card);
            });
        }

        function selectAnswer(card, selected) {

            document.querySelectorAll('.option-card')
                .forEach(btn => btn.classList.remove('active'));

            card.classList.add('active');

            const q = questions[currentQuestion];

            feedbackBox.classList.remove('hidden');

            if (q.correct.includes(selected)) {

                feedbackBox.className =
                    "bg-green-100 border-l-4 border-green-600 rounded-2xl p-5 text-lg leading-relaxed mb-10";

                feedbackBox.innerHTML = q.correctFeedback;

            } else {

                feedbackBox.className =
                    "bg-orange-100 border-l-4 border-orange-500 rounded-2xl p-5 text-lg leading-relaxed mb-10";

                feedbackBox.innerHTML = q.wrongFeedback;
            }

            nextBtn.disabled = false;

            nextBtn.className =
                "btn-pulse bg-[#5eb15e] hover:bg-green-700 text-white px-10 py-4 rounded-xl font-bold text-xl flex items-center gap-3 transition-all shadow-lg";
        }

        nextBtn.onclick = () => {

    currentQuestion++;

    if(currentQuestion < questions.length){

        loadQuestion();

    }else{

        quizBox.innerHTML = `

            <div class="flex flex-col items-center justify-center h-full text-center">

                <h1 class="text-5xl font-extrabold mb-8 text-[#5f8f45]">
                    🎉 Fase 2 Selesai!
                </h1>

                <p class="text-2xl text-gray-700 max-w-3xl leading-relaxed mb-12">
                    Sekarang kamu memahami bahwa data digital juga membutuhkan perlindungan seperti barang berharga di dunia nyata.
                </p>

                <form method="POST" action="{{ route('fase2.complete') }}">
                    @csrf

                    <button
                        type="submit"
                        class="btn-pulse bg-[#5eb15e] hover:bg-green-700 text-white px-12 py-5 rounded-xl font-bold text-2xl transition-all">

                        Lanjut ke Fase 3 →

                    </button>

                </form>

            </div>

        `;

    }

};

loadQuestion();
        loadQuestion();

    </script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once: true, duration: 600, offset: 20 });</script>
</body>
</html>
