<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fase 4 - Blockly OOP</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://unpkg.com/blockly/blockly.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }

        #blocklyDiv{
            height:550px;
            width:100%;
        }

        .blocklyToolboxDiv{
            background:#f8fafc;
        }

        pre{
            white-space:pre-wrap;
            word-wrap:break-word;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

    @include('sidebar-siswa')

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        @include('_navbar', ['navTitle' => 'Fase 4 – Aplikasi'])
        <div class="flex-1 overflow-y-auto p-8">

        {{-- CONTENT --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-10 min-h-[80vh]">

            {{-- Phase badge --}}
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center gap-1.5 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Fase 4 dari 5
                </span>
                <span class="text-xs text-gray-400 font-medium">Model Needham Lima Fase</span>
            </div>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-1">
                Aplikasi
                <span class="text-green-600">— Class Student</span>
            </h2>

            <p class="text-sm text-gray-500 mb-5">
                Buat struktur OOP menggunakan block programming.
            </p>

            @include('_needham-stepper', ['currentFase' => 4])


            <ul class="list-disc ml-6 text-sm text-gray-600 mb-6 space-y-1">
                <li>Membuat class Student</li>
                <li>Private attribute nilai</li>
                <li>Method getNilai()</li>
                <li>Method setNilai()</li>
            </ul>

            <div class="grid grid-cols-12 gap-6">

                {{-- WORKSPACE --}}
                <div class="col-span-8">

                    <div class="border-2 border-gray-300 rounded-2xl overflow-hidden">

                        <div class="border-b border-gray-300 p-4 text-base font-bold text-gray-700 text-center">
                            Workspace Blockly
                        </div>

                        <div id="blocklyDiv"></div>

                    </div>

                    <div class="flex justify-end gap-4 mt-6">

                        <button
                            id="resetBtn"
                            class="border border-gray-400 px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-100">

                            Reset

                        </button>

                        <button
                            id="runBtn"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm">

                            Run →

                        </button>

                    </div>

                </div>

                {{-- OUTPUT --}}
                <div class="col-span-4">

                    <div class="border-2 border-gray-300 rounded-2xl overflow-hidden">

                        <div class="border-b border-gray-300 p-4 text-center text-3xl font-bold">
                            Hasil Program
                        </div>

                        <div class="p-4">

                            <pre id="result"
                                 class="bg-gray-100 rounded-xl p-4 min-h-[350px] text-sm overflow-auto"></pre>

                            <div id="successBox"
                                 class="hidden mt-4 border-2 border-green-300 bg-green-50 rounded-xl p-5 text-center font-semibold">

                                ✅ Data terlindungi dengan enkapsulasi

                            </div>

                            <div id="failBox"
                                 class="hidden mt-4 border-2 border-red-300 bg-red-50 rounded-xl p-5 text-center font-semibold">

                                ❌ Struktur OOP belum sesuai

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        </div>
    </main>

</div>

{{-- TOOLBOX --}}
<xml id="toolbox" style="display:none">

    <category name="OOP" colour="#5C81A6">

        <block type="oop_class"></block>

        <block type="oop_attribute"></block>

        <block type="oop_private"></block>

        <block type="oop_getter"></block>

        <block type="oop_setter"></block>

    </category>

</xml>

<script src="{{ asset('js/blockly/oop-blocks.js') }}"></script>

<script src="{{ asset('js/blockly/oop-generator.js') }}"></script>

<script>

let workspace = Blockly.inject(
    'blocklyDiv',
    {
        toolbox: document.getElementById('toolbox'),
        scrollbars:true,
        trashcan:true
    }
);

document.getElementById('runBtn').addEventListener('click', () => {

    let hasil = generateCode(workspace);

    document.getElementById('result').innerText = hasil;

    const successBox =
        document.getElementById('successBox');

    const failBox =
        document.getElementById('failBox');

    let code = hasil.toLowerCase();

    let valid =
        code.includes('class student') &&
        code.includes('__nilai') &&
        code.includes('getnilai') &&
        code.includes('setnilai');

    if(valid){

        successBox.classList.remove('hidden');
        failBox.classList.add('hidden');

    }else{

        failBox.classList.remove('hidden');
        successBox.classList.add('hidden');
    }
});

document.getElementById('resetBtn').addEventListener('click', () => {

    workspace.clear();

    document.getElementById('result').innerText = '';

    document.getElementById('successBox')
        .classList.add('hidden');

    document.getElementById('failBox')
        .classList.add('hidden');
});

</script>

</body>
</html>
