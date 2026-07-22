<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Builder: Kapsul Enkapsulasi</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e9ecef; margin: 0; }
        .header { background: #1e293b; color: white; padding: 15px 30px; text-align: center; }

        .container { display: flex; padding: 20px; gap: 20px; height: 75vh; }
        .panel { background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; flex: 1; display: flex; flex-direction: column;}
        .panel h3 { margin-top: 0; color: #495057; border-bottom: 2px solid #e9ecef; padding-bottom: 10px;}

        /* Editor Live Typing */
        textarea {
            flex: 1;
            background: #282c34;
            color: #61afef;
            font-family: monospace;
            font-size: 1.2em;
            padding: 15px;
            border-radius: 5px;
            border: none;
            outline: none;
            resize: none;
            line-height: 1.5;
        }

        /* Area Visualisasi (Pabrik Kapsul) */
        .factory-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            position: relative;
        }

        /* Bagian-bagian Kapsul (Awalnya Hilang / Transparan) */
        .capsule-shell {
            width: 300px;
            height: 140px;
            border-radius: 70px;
            border: 4px dashed #94a3b8; /* Blueprint style awalnya */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.5s ease;
            opacity: 0; transform: scale(0.8);
        }

        .private-core {
            background: #e74c3c;
            color: white;
            padding: 15px 30px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: inset 0 3px 6px rgba(0,0,0,0.3);
            opacity: 0; transform: scale(0);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .door-setter, .door-getter {
            position: absolute;
            top: 45px;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            opacity: 0;
            transition: all 0.5s;
            border: 2px solid #1e293b;
            z-index: 10;
        }
        .door-setter { left: -30px; background: #2ecc71; transform: translateX(-20px); }
        .door-getter { right: -30px; background: #f39c12; transform: translateX(20px); }

        /* Class State saat terbentuk */
        .show-shell { opacity: 1; transform: scale(1); }
        .show-core { opacity: 1; transform: scale(1); }
        .show-setter { opacity: 1; transform: translateX(0); }
        .show-getter { opacity: 1; transform: translateX(0); }

        /* State Solid saat Instansiasi */
        .solid-capsule {
            border: 4px solid #1e293b;
            background: linear-gradient(90deg, #3b82f6 50%, #e2e8f0 50%);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .instruction-box { margin-top: 15px; background: #e0f2fe; color: #0369a1; padding: 15px; border-radius: 5px; font-weight: bold;}
    </style>
</head>
<body>
    <div class="header">
        <h2>Pabrik Objek: Ketik Kode untuk Merakit Kapsul</h2>
    </div>

    <div class="container">
        <div class="panel">
            <h3>📝 Ketik Kodinganmu di Sini:</h3>
            <textarea id="code-editor" spellcheck="false" placeholder="Ketik kode class Minuman di sini..."></textarea>
            <div class="instruction-box" id="instruction">
                Tugas 1: Buat cetak biru kapsul dengan mengetik: <strong>class Minuman:</strong>
            </div>
        </div>

        <div class="panel">
            <h3>💊 Perakitan Kapsul (Real-Time)</h3>
            <div class="factory-area">

                <div class="capsule-shell" id="vis-shell">
                    <div class="door-setter" id="vis-setter">📥 Setter</div>

                    <div class="private-core" id="vis-core">
                        🔒 __volume
                    </div>

                    <div class="door-getter" id="vis-getter">Getter 📤</div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editor = document.getElementById("code-editor");
            const instruction = document.getElementById("instruction");

            // Visual Elements
            const visShell = document.getElementById("vis-shell");
            const visCore = document.getElementById("vis-core");
            const visSetter = document.getElementById("vis-setter");
            const visGetter = document.getElementById("vis-getter");

            // Event Listener setiap kali tombol keyboard dilepas (siswa mengetik)
            editor.addEventListener("keyup", () => {
                const code = editor.value; // Ambil teks yang diketik siswa

                // 1. Cek apakah mengetik "class"
                if (code.includes("class Minuman")) {
                    visShell.classList.add("show-shell");
                    instruction.innerHTML = "Tugas 2: Masukkan data private (inti kapsul) dengan mengetik: <strong>__volume</strong>";
                } else {
                    visShell.classList.remove("show-shell");
                }

                // 2. Cek apakah memasukkan variabel private (double underscore)
                if (code.includes("__volume")) {
                    visCore.classList.add("show-core");
                    instruction.innerHTML = "Tugas 3: Buat pintu masuk agar data bisa diubah dengan aman. Ketik fungsi: <strong>def set_volume</strong>";
                } else {
                    visCore.classList.remove("show-core");
                }

                // 3. Cek apakah membuat fungsi Setter
                if (code.includes("def set_")) {
                    visSetter.classList.add("show-setter");
                    instruction.innerHTML = "Tugas 4: Buat pintu keluar agar data bisa dibaca. Ketik fungsi: <strong>def get_volume</strong>";
                } else {
                    visSetter.classList.remove("show-setter");
                }

                // 4. Cek apakah membuat fungsi Getter
                if (code.includes("def get_")) {
                    visGetter.classList.add("show-getter");
                    instruction.innerHTML = "Tugas Terakhir: Wujudkan blueprint ini menjadi objek nyata (kapsul solid). Ketik: <strong>minuman1 = Minuman()</strong>";
                } else {
                    visGetter.classList.remove("show-getter");
                }

                // 5. Cek Instansiasi (Membuat objek)
                if (code.includes("minuman1 = Minuman()")) {
                    visShell.classList.add("solid-capsule");
                    instruction.innerHTML = "🎉 LUAR BIASA! Cetak biru telah dicetak menjadi Kapsul Fisik yang siap digunakan!";
                    instruction.style.backgroundColor = "#d1e7dd";
                    instruction.style.color = "#0f5132";
                } else {
                    visShell.classList.remove("solid-capsule");
                    instruction.style.backgroundColor = "#e0f2fe";
                    instruction.style.color = "#0369a1";
                }
            });
        });
    </script>
</body>
</html>
