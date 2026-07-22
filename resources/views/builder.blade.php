@extends('layouts.app')
@section('title', 'Blueprint Builder')

@push('styles')
<style>
/* ─── PHASE INDICATOR ──────────────────────────────────── */
.phase-bar{display:flex;align-items:center;gap:0;margin-bottom:24px;overflow:hidden;border-radius:10px;border:1px solid var(--border);}
.phase-step{
  flex:1;display:flex;align-items:center;justify-content:center;gap:8px;
  padding:11px 16px;font-size:12.5px;color:var(--faint);background:var(--panel);
  transition:.2s;border-right:1px solid var(--border);cursor:pointer;
}
.phase-step:last-child{border-right:none;}
.phase-step .num{
  width:22px;height:22px;border-radius:50%;border:1.5px solid var(--border);
  display:flex;align-items:center;justify-content:center;font-family:var(--mono);
  font-size:11px;flex-shrink:0;transition:.2s;
}
.phase-step.done{color:var(--dim);}
.phase-step.done .num{background:var(--faint);border-color:var(--faint);color:var(--bg);}
.phase-step.active{color:var(--amber);background:var(--amber-bg);}
.phase-step.active .num{background:var(--amber);border-color:var(--amber);color:#1a0e00;font-weight:700;}

/* ─── SHARED PANELS ────────────────────────────────────── */
.panel{background:var(--panel);border:1px solid var(--border);border-radius:var(--r);}
.panel-hdr{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border-bottom:1px solid var(--border2);}
.panel-hdr h3{font-size:11px;font-family:var(--mono);text-transform:uppercase;letter-spacing:.9px;color:var(--faint);font-weight:600;}
.panel-body{padding:14px;}
.btn{font-family:var(--sans);font-size:13px;font-weight:500;border:none;border-radius:8px;padding:9px 16px;cursor:pointer;transition:.15s;display:inline-flex;align-items:center;gap:6px;}
.btn-amber{background:var(--amber);color:#1a0e00;font-weight:600;}
.btn-amber:hover{filter:brightness(1.07);}
.btn-amber:disabled{opacity:.4;cursor:not-allowed;}
.btn-ghost{background:transparent;color:var(--dim);border:1px solid var(--border);}
.btn-ghost:hover{color:var(--text);border-color:#3a4254;}
.btn-green{background:var(--green);color:#0d1e10;font-weight:600;}
.btn-green:hover{filter:brightness(1.07);}
.btn-rose{background:var(--rose-bg);color:var(--rose);border:1px solid rgba(255,122,138,.3);}

/* ─── PHASE 1: BLUEPRINT BUILDER ──────────────────────── */
#phase1{display:block;}
.builder-layout{display:grid;grid-template-columns:340px 1fr;gap:14px;align-items:start;}
@media(max-width:900px){.builder-layout{grid-template-columns:1fr;}}

/* class tabs */
.class-tabs{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:14px;}
.cls-tab{font-family:var(--mono);font-size:12px;padding:6px 12px;border-radius:7px;
  border:1px solid var(--border);background:var(--panel);color:var(--dim);cursor:pointer;transition:.15s;
  display:flex;align-items:center;gap:6px;}
.cls-tab:hover{border-color:#3a4254;color:var(--text);}
.cls-tab.active{border-color:var(--cyan);color:var(--cyan);background:rgba(106,214,232,.07);}
.cls-tab .del-cls{color:var(--faint);font-size:14px;line-height:1;padding:0 2px;}
.cls-tab .del-cls:hover{color:var(--rose);}
.btn-add-cls{font-family:var(--mono);font-size:12px;padding:6px 11px;border-radius:7px;
  border:1.5px dashed var(--border);background:transparent;color:var(--faint);cursor:pointer;transition:.15s;}
.btn-add-cls:hover{border-color:var(--amber);color:var(--amber);}

/* class editor form */
.form-field{margin-bottom:14px;}
.form-label{font-size:11.5px;color:var(--faint);font-weight:500;margin-bottom:5px;display:block;font-family:var(--mono);letter-spacing:.5px;text-transform:uppercase;}
.form-input{width:100%;padding:9px 11px;background:var(--panel2);border:1px solid var(--border);
  border-radius:7px;color:var(--text);font-size:13px;}
.form-input:focus{outline:none;border-color:var(--amber);}
select.form-input option{background:var(--panel2);}

/* attr/method rows */
.attr-list,.meth-list{display:flex;flex-direction:column;gap:7px;margin-bottom:8px;}
.attr-row,.meth-row{
  display:flex;align-items:center;gap:6px;
  background:var(--panel2);border:1px solid var(--border);border-radius:8px;padding:7px 9px;
}
.vis-badge{
  font-family:var(--mono);font-size:11px;font-weight:700;cursor:pointer;
  width:22px;height:22px;border-radius:5px;display:flex;align-items:center;justify-content:center;
  flex-shrink:0;border:1.5px solid transparent;transition:.15s;
}
.vis-badge.pub{color:var(--green);border-color:rgba(126,224,138,.4);background:rgba(126,224,138,.07);}
.vis-badge.pro{color:var(--amber);border-color:rgba(255,180,84,.4);background:rgba(255,180,84,.07);}
.vis-badge.priv{color:var(--rose);border-color:rgba(255,122,138,.4);background:rgba(255,122,138,.07);}
.mini-input{
  flex:1;background:transparent;border:none;color:var(--text);font-family:var(--mono);font-size:12px;
  padding:2px 4px;min-width:0;
}
.mini-input::placeholder{color:var(--faint);}
.mini-input:focus{outline:none;}
.type-input{width:72px;background:transparent;border:none;color:var(--violet);font-family:var(--mono);font-size:11.5px;padding:2px 4px;}
.type-input::placeholder{color:var(--faint);}
.type-input:focus{outline:none;}
.colon{color:var(--faint);font-family:var(--mono);font-size:12px;flex-shrink:0;}
.btn-del-row{background:transparent;border:none;color:var(--faint);cursor:pointer;font-size:16px;flex-shrink:0;padding:0 2px;line-height:1;}
.btn-del-row:hover{color:var(--rose);}
.ret-sep{color:var(--faint);font-family:var(--mono);font-size:11px;flex-shrink:0;}
.btn-add-row{
  font-family:var(--mono);font-size:11.5px;color:var(--faint);background:transparent;
  border:1px dashed var(--border2);border-radius:7px;padding:5px 10px;cursor:pointer;
  transition:.15s;width:100%;text-align:left;
}
.btn-add-row:hover{border-color:var(--amber);color:var(--amber);}

/* live diagram (right panel) */
.diagram-container{
  position:sticky;top:72px;background:var(--panel);border:1px solid var(--border);
  border-radius:var(--r);min-height:300px;
}
.diagram-svg-wrap{padding:20px;overflow:auto;min-height:260px;display:flex;align-items:flex-start;justify-content:center;}
.diagram-hint-bar{padding:8px 14px 12px;font-size:11.5px;color:var(--faint);border-top:1px solid var(--border2);}
.code-preview-box{
  margin:0 14px 14px;background:var(--panel2);border:1px solid var(--border2);border-radius:8px;
  padding:12px 14px;font-family:var(--mono);font-size:11.5px;line-height:1.9;max-height:220px;
  overflow:auto;
}
.kw{color:var(--violet);}
.fn-c{color:var(--cyan);}
.st-c{color:var(--green);}
.cm-c{color:var(--faint);font-style:italic;}
.priv-c{color:var(--rose);}

/* phase1 footer */
.phase1-footer{display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap;}

/* ─── PHASE 2: CODE EDITOR ─────────────────────────────── */
#phase2{display:none;}
.code-layout{display:grid;grid-template-columns:260px 1fr;gap:14px;align-items:start;}
@media(max-width:860px){.code-layout{grid-template-columns:1fr;}}
.code-sidebar{display:flex;flex-direction:column;gap:12px;position:sticky;top:72px;}
textarea#codeEditor{
  width:100%;min-height:380px;font-family:var(--mono);font-size:13px;line-height:1.9;
  background:var(--panel);border:1px solid var(--border);border-radius:var(--r);
  color:var(--text);padding:16px;resize:vertical;caret-color:var(--amber);
}
textarea#codeEditor:focus{outline:none;border-color:var(--amber);}
.tip-item{display:flex;gap:8px;font-size:12.5px;color:var(--dim);padding:5px 0;line-height:1.5;}
.tip-item .tip-dot{width:6px;height:6px;border-radius:50%;background:var(--amber);flex-shrink:0;margin-top:5px;}
.pred-box{background:var(--amber-dim);border:1px solid var(--amber);border-radius:var(--r);padding:13px 14px;}
.pred-label{font-family:var(--mono);font-size:10.5px;text-transform:uppercase;letter-spacing:.9px;color:var(--amber);margin-bottom:6px;}
textarea.pred-input{width:100%;min-height:68px;font-family:var(--sans);font-size:13px;
  background:var(--bg);border:1px solid var(--border);border-radius:7px;color:var(--text);
  padding:9px 10px;resize:vertical;}
textarea.pred-input:focus{outline:none;border-color:var(--amber);}
.phase2-footer{display:flex;align-items:center;gap:12px;margin-top:16px;flex-wrap:wrap;}
.loader-row{display:none;align-items:center;gap:10px;}
.loader-row.show{display:flex;}
.spin{width:18px;height:18px;border:2px solid var(--border);border-top-color:var(--amber);border-radius:50%;animation:spin .8s linear infinite;}
@keyframes spin{to{transform:rotate(360deg)}}

/* ─── PHASE 3: SIMULATION ──────────────────────────────── */
#phase3{display:none;}
.sim-header{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap;}
.sim-header h2{font-size:14px;font-weight:600;}
.sim-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;}
@media(max-width:820px){.sim-grid{grid-template-columns:1fr;}}
.code-viewer{font-family:var(--mono);font-size:12.5px;line-height:2;max-height:320px;overflow:auto;}
.cl{display:flex;padding:0 12px;border-left:3px solid transparent;white-space:pre;}
.cl.active{background:var(--amber-bg);border-left-color:var(--amber);}
.cl.error-line{background:var(--rose-bg);border-left-color:var(--rose);}
.ln{color:var(--faint);width:22px;flex-shrink:0;user-select:none;}
.ct{color:var(--dim);}
.cl.active .ct,.cl.error-line .ct{color:var(--text);}
.obj-card{flex:1 1 190px;border-radius:8px;padding:11px 13px;border:1px solid var(--border);background:var(--panel2);}
.obj-title{font-family:var(--mono);font-size:12px;font-weight:700;color:var(--cyan);margin-bottom:8px;}
.obj-title .oty{color:var(--faint);font-weight:400;}
.arow{display:flex;justify-content:space-between;font-family:var(--mono);font-size:11.5px;padding:2.5px 0;}
.akey{color:var(--dim);}
.aval{color:var(--text);}
.ibadge{font-size:9px;color:var(--violet);border:1px solid rgba(183,148,246,.4);border-radius:3px;padding:1px 4px;font-family:var(--sans);}
.pbadge{font-size:9px;color:var(--rose);border:1px solid rgba(255,122,138,.3);border-radius:3px;padding:1px 4px;font-family:var(--sans);}
.cons{font-family:var(--mono);font-size:12.5px;min-height:50px;}
.cline{padding:2px 0;color:var(--dim);}
.cline.cerr{color:var(--rose);}
.cline.cok{color:var(--green);}
.cempty{color:var(--faint);}
.narr{background:var(--panel);border:1px solid var(--border);border-radius:var(--r);padding:12px 16px;font-size:13px;line-height:1.6;color:var(--dim);margin-bottom:14px;}
.narr b{color:var(--text);}
.narr code{font-family:var(--mono);font-size:11.5px;background:var(--panel2);padding:1px 5px;border-radius:4px;}
.pred-sim-box{border:1px solid var(--amber);background:var(--amber-dim);border-radius:var(--r);padding:14px;margin-bottom:14px;}
.pred-sim-q{font-size:13px;color:var(--text);margin:6px 0 10px;}
.pred-irow{display:flex;gap:8px;}
.pred-irow input{flex:1;font-family:var(--sans);font-size:13px;padding:9px 10px;border-radius:7px;border:1px solid var(--border);background:var(--bg);color:var(--text);}
.pred-irow input:focus{outline:none;border-color:var(--amber);}
.refl-box{border:1px solid var(--border);background:var(--panel);border-radius:var(--r);padding:15px;margin-bottom:14px;}
.refl-label{font-family:var(--mono);font-size:10.5px;text-transform:uppercase;letter-spacing:.9px;color:var(--green);margin-bottom:8px;}
.tl{display:flex;align-items:center;gap:3px;overflow-x:auto;padding:4px 2px;margin-bottom:12px;}
.tn{width:9px;height:9px;border-radius:50%;background:var(--border);flex-shrink:0;cursor:pointer;transition:.15s;}
.tn.done{background:var(--faint);}
.tn.cur{background:var(--amber);box-shadow:0 0 0 4px rgba(255,180,84,.18);}
.tn.err{background:var(--rose);}
.tl-line{height:1px;background:var(--border);flex:1;min-width:5px;}
.tl-line.done{background:var(--faint);}
.ctrl-row{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.ctrl-left{display:flex;gap:8px;}
.cbtn{width:36px;height:36px;border-radius:8px;border:1px solid var(--border);background:var(--panel);color:var(--text);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;transition:.15s;}
.cbtn:hover:not(:disabled){border-color:var(--amber);color:var(--amber);}
.cbtn:disabled{opacity:.3;cursor:not-allowed;}
.cbtn.wide{width:auto;padding:0 14px;font-family:var(--sans);font-size:12px;gap:5px;}
.step-info{font-family:var(--mono);font-size:12px;color:var(--faint);}
.frame-badge{font-family:var(--mono);font-size:11px;background:var(--panel2);border:1px solid var(--border);border-radius:5px;padding:3px 8px;color:var(--dim);}
</style>
@endpush

@section('content')

<!-- ── PHASE INDICATOR ───────────────────────────────────────── -->
<div class="phase-bar">
  <div class="phase-step active" id="tab1" onclick="goPhase(1)">
    <div class="num">1</div><span>Blueprint Class</span>
  </div>
  <div class="phase-step" id="tab2" onclick="goPhase(2)">
    <div class="num">2</div><span>Editor Kode</span>
  </div>
  <div class="phase-step" id="tab3" onclick="goPhase(3)">
    <div class="num">3</div><span>Simulasi</span>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════════════
     PHASE 1 — BLUEPRINT BUILDER
═══════════════════════════════════════════════════════════════ -->
<div id="phase1">

  <!-- Class Tabs -->
  <div class="class-tabs" id="classTabs"></div>

  <div class="builder-layout">

    <!-- LEFT: Editor Form -->
    <div>
      <div class="panel">
        <div class="panel-hdr">
          <h3 id="editorTitle">Definisi Class</h3>
          <span style="font-size:11px;color:var(--faint);font-family:var(--mono);">klik + untuk ganti visibilitas</span>
        </div>
        <div class="panel-body">

          <!-- Class Name -->
          <div class="form-field">
            <label class="form-label">Nama Class</label>
            <input class="form-input" id="clsName" type="text" placeholder="Contoh: Motor, Kendaraan, Akun..." autocomplete="off">
          </div>

          <!-- Parent (Inheritance) -->
          <div class="form-field">
            <label class="form-label">Mewarisi dari (opsional)</label>
            <select class="form-input" id="clsParent">
              <option value="">— Tidak ada (class berdiri sendiri) —</option>
            </select>
          </div>

          <!-- Attributes -->
          <div class="form-field">
            <label class="form-label" style="margin-bottom:8px;">Atribut</label>
            <div class="attr-list" id="attrList"></div>
            <button class="btn-add-row" onclick="addAttr()">＋ Tambah Atribut</button>
          </div>

          <!-- Methods -->
          <div class="form-field" style="margin-bottom:0;">
            <label class="form-label" style="margin-bottom:8px;">Method</label>
            <div class="meth-list" id="methList"></div>
            <button class="btn-add-row" onclick="addMeth()">＋ Tambah Method</button>
          </div>

        </div>
      </div>
    </div>

    <!-- RIGHT: Live Diagram + Code Preview -->
    <div class="diagram-container">
      <div class="panel-hdr">
        <h3>Diagram class (live)</h3>
        <span style="font-size:11px;color:var(--faint);">diperbarui otomatis</span>
      </div>
      <div class="diagram-svg-wrap" id="diagramWrap">
        <!-- SVG generated by JS -->
      </div>
      <div class="diagram-hint-bar">
        <span style="color:var(--violet);">▪ ungu</span> = class anak &nbsp;·&nbsp;
        <span style="color:var(--cyan);">▪ cyan</span> = class induk &nbsp;·&nbsp;
        <span style="color:var(--rose);">- priv</span> &nbsp;
        <span style="color:var(--amber);"># prot</span> &nbsp;
        <span style="color:var(--green);">+ pub</span>
      </div>
      <div class="panel-hdr" style="border-top:1px solid var(--border2);">
        <h3>Preview kode yang akan digenerate</h3>
      </div>
      <div class="code-preview-box" id="codePreview"></div>
    </div>

  </div><!-- /builder-layout -->

  <div class="phase1-footer">
    <button class="btn-add-cls" onclick="addClass()">＋ Tambah Class Lain</button>
    <div style="flex:1;"></div>
    <button class="btn btn-amber" onclick="goToCodeEditor()">Generate Kode &amp; Lanjut →</button>
  </div>

</div><!-- /phase1 -->

<!-- ══════════════════════════════════════════════════════════════
     PHASE 2 — CODE EDITOR
═══════════════════════════════════════════════════════════════ -->
<div id="phase2">

  <div class="code-layout">

    <!-- Sidebar -->
    <div class="code-sidebar">
      <!-- Mini diagram -->
      <div class="panel">
        <div class="panel-hdr"><h3>Blueprint ringkas</h3></div>
        <div class="panel-body" style="padding:10px;">
          <div id="miniDiagram" style="overflow:auto;max-height:220px;display:flex;justify-content:center;"></div>
        </div>
      </div>
      <!-- Tips -->
      <div class="panel">
        <div class="panel-hdr"><h3>Panduan mengisi</h3></div>
        <div class="panel-body">
          <div class="tip-item"><div class="tip-dot"></div><div>Isi badan setiap method — ganti <code style="font-family:var(--mono);font-size:11px;background:var(--panel2);padding:1px 4px;border-radius:3px;">pass</code> dengan logika yang sesuai.</div></div>
          <div class="tip-item"><div class="tip-dot"></div><div>Tambahkan pemanggilan objek di bawah definisi class untuk menguji kode.</div></div>
          <div class="tip-item"><div class="tip-dot"></div><div>Gunakan <code style="font-family:var(--mono);font-size:11px;background:var(--panel2);padding:1px 4px;border-radius:3px;">print()</code> agar output tampil di console simulasi.</div></div>
          <div class="tip-item"><div class="tip-dot"></div><div>Atribut privat (<code style="font-family:var(--mono);font-size:11px;background:var(--panel2);padding:1px 4px;border-radius:3px;">__nama</code>) hanya bisa diakses dari dalam class.</div></div>
        </div>
      </div>
      <!-- Prediksi awal -->
      <div class="pred-box">
        <div class="pred-label">Prediksi Awal</div>
        <p style="font-size:12.5px;color:var(--dim);margin-bottom:8px;">Sebelum menjalankan — apa yang kamu prediksi akan terjadi?</p>
        <textarea class="pred-input" id="predAwal" placeholder="Tulis prediksimu..."></textarea>
      </div>
    </div>

    <!-- Code editor -->
    <div>
      <div class="panel">
        <div class="panel-hdr">
          <h3>Kode Python — lengkapi badan method</h3>
          <button class="btn-ghost btn" style="padding:5px 10px;font-size:11.5px;" onclick="resetCode()">↺ Reset ke Blueprint</button>
        </div>
        <div class="panel-body" style="padding:0;">
          <textarea id="codeEditor" spellcheck="false"></textarea>
        </div>
      </div>
    </div>

  </div><!-- /code-layout -->

  <div class="phase2-footer">
    <button class="btn btn-ghost" onclick="goPhase(1)">← Kembali ke Blueprint</button>
    <button class="btn btn-amber" id="btnJalankan" onclick="jalankanSimulasi()">▶ Jalankan Simulasi</button>
    <div class="loader-row" id="loaderRow">
      <div class="spin"></div>
      <span style="font-size:13px;color:var(--dim);" id="loaderMsg">Mengeksekusi Python…</span>
    </div>
    <div id="runError" style="font-family:var(--mono);font-size:12.5px;color:var(--rose);display:none;"></div>
  </div>

</div><!-- /phase2 -->

<!-- ══════════════════════════════════════════════════════════════
     PHASE 3 — SIMULATION PLAYER
═══════════════════════════════════════════════════════════════ -->
<div id="phase3">

  <div class="sim-header">
    <div style="width:34px;height:34px;border-radius:8px;background:linear-gradient(145deg,var(--cyan),#3ab8d0);display:flex;align-items:center;justify-content:center;font-size:13px;color:#0d1a1e;">▶</div>
    <div>
      <h2 id="simTitle">Simulasi aktif</h2>
      <p style="font-size:12px;color:var(--dim);" id="simSubtitle"></p>
    </div>
    <button class="btn btn-ghost" onclick="goPhase(2)" style="margin-left:auto;">← Edit Kode</button>
  </div>

  <div class="sim-grid">
    <!-- Diagram (read-only) -->
    <div class="panel">
      <div class="panel-hdr">
        <h3>Diagram class</h3>
        <button class="btn-ghost btn" style="padding:4px 9px;font-size:11.5px;" id="btnToggleDiag">Sembunyikan</button>
      </div>
      <div id="simDiagBody">
        <div style="padding:14px;display:flex;justify-content:center;" id="simDiagSvg"></div>
      </div>
    </div>
    <!-- Code viewer -->
    <div class="panel">
      <div class="panel-hdr">
        <h3>Kode tersinkronisasi</h3>
        <span class="frame-badge" id="frameBadge">modul</span>
      </div>
      <div class="panel-body" style="padding:10px 0;">
        <div class="code-viewer" id="codeViewer"></div>
      </div>
    </div>
    <!-- Objects -->
    <div class="panel">
      <div class="panel-hdr"><h3>Status objek (memori)</h3></div>
      <div class="panel-body" id="objBody"></div>
    </div>
    <!-- Console -->
    <div class="panel">
      <div class="panel-hdr"><h3>Console output</h3></div>
      <div class="panel-body"><div class="cons" id="consBody"></div></div>
    </div>
  </div>

  <!-- Narration -->
  <div class="narr" id="narr"></div>

  <!-- Predict (conditional) -->
  <div class="pred-sim-box" id="predSimBox" style="display:none;">
    <div class="pred-label">Prediksi sebelum lanjut</div>
    <div class="pred-sim-q" id="predSimQ"></div>
    <div class="pred-irow">
      <input type="text" id="predSimIn" placeholder="Tulis prediksimu...">
      <button class="btn btn-amber" onclick="checkPred()" style="padding:9px 14px;">Periksa</button>
    </div>
    <div id="predSimResult" style="margin-top:10px;display:none;font-family:var(--mono);font-size:12px;"></div>
  </div>

  <!-- Reflection (last step) -->
  <div class="refl-box" id="reflBox" style="display:none;">
    <div class="refl-label">Refleksi Akhir</div>
    <p style="font-size:13px;color:var(--dim);margin-bottom:10px;line-height:1.55;" id="reflQ"></p>
    <div style="display:flex;gap:8px;">
      <textarea style="flex:1;min-height:70px;font-family:var(--sans);font-size:12.5px;background:var(--bg);border:1px solid var(--border);border-radius:7px;color:var(--text);padding:9px;resize:vertical;" id="reflIn" placeholder="Tulis kesimpulanmu..."></textarea>
      <button class="btn btn-green" style="align-self:flex-start;" onclick="simpanRefleksi()">Simpan</button>
    </div>
  </div>

  <!-- Timeline -->
  <div class="tl" id="tl"></div>

  <!-- Controls -->
  <div class="ctrl-row">
    <div class="ctrl-left">
      <button class="cbtn wide" onclick="resetSim()">↺ Reset</button>
      <button class="cbtn" id="btnPrev">‹</button>
      <button class="cbtn" id="btnNext">›</button>
    </div>
    <span class="step-info" id="stepInfo"></span>
  </div>

</div><!-- /phase3 -->

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/pyodide/v0.26.4/full/pyodide.js"></script>
<script>
/* ══════════════════════════════════════════════════════════════
   STATE — Blueprint
══════════════════════════════════════════════════════════════ */
let classes = [newClass('Kendaraan')];
let activeId = classes[0].id;
let generatedCode = '';
let traceSteps = [], traceClasses = [], stepIdx = 0;
let codeLines = [], predAnswered = {}, predInitial = '';
let pyodide = null;
let diagVisible = true;
let sessionToken = null;

function newClass(name = '') {
  return {
    id: 'c' + Date.now() + Math.random().toString(36).slice(2, 6),
    name, parentId: null,
    attrs: [],
    meths: []
  };
}
function newAttr() { return { id: 'a' + Date.now(), vis: 'pub', name: '', type: '' }; }
function newMeth() { return { id: 'm' + Date.now(), vis: 'pub', name: '', params: '', ret: '' }; }

/* ══════════════════════════════════════════════════════════════
   PHASE NAVIGATION
══════════════════════════════════════════════════════════════ */
function goPhase(n) {
  [1,2,3].forEach(i => {
    document.getElementById('phase'+i).style.display = i===n ? 'block' : 'none';
    const tab = document.getElementById('tab'+i);
    tab.className = 'phase-step' + (i<n?' done':i===n?' active':'');
  });
  if (n===2) {
    generatedCode = generateCode();
    document.getElementById('codeEditor').value = generatedCode;
    renderMiniDiagram();
  }
  if (n===3) {
    document.getElementById('simDiagSvg').innerHTML = buildDiagramSVG(traceClasses);
  }
  window.scrollTo({top:0,behavior:'smooth'});
}

/* ══════════════════════════════════════════════════════════════
   CLASS MANAGEMENT
══════════════════════════════════════════════════════════════ */
function addClass() {
  const cls = newClass('');
  classes.push(cls);
  activeId = cls.id;
  renderTabs();
  renderEditor();
  renderDiagram();
  renderCodePreview();
}

function deleteClass(id) {
  if (classes.length === 1) return;
  classes = classes.filter(c => c.id !== id);
  // Clear broken parent refs
  classes.forEach(c => { if (c.parentId === id) c.parentId = null; });
  activeId = classes[classes.length - 1].id;
  renderTabs(); renderEditor(); renderDiagram(); renderCodePreview();
}

function setActive(id) {
  activeId = id;
  renderTabs(); renderEditor();
}

function getActive() { return classes.find(c => c.id === activeId); }

/* ══════════════════════════════════════════════════════════════
   RENDER TABS
══════════════════════════════════════════════════════════════ */
function renderTabs() {
  const wrap = document.getElementById('classTabs');
  wrap.innerHTML = '';
  classes.forEach(cls => {
    const div = document.createElement('div');
    div.className = 'cls-tab' + (cls.id === activeId ? ' active' : '');
    div.onclick = () => setActive(cls.id);
    div.innerHTML = `<span>${cls.name || '<em>tanpa nama</em>'}</span>`
      + (classes.length > 1
        ? `<span class="del-cls" onclick="event.stopPropagation();deleteClass('${cls.id}')">×</span>`
        : '');
    wrap.appendChild(div);
  });
}

/* ══════════════════════════════════════════════════════════════
   RENDER EDITOR FORM
══════════════════════════════════════════════════════════════ */
function renderEditor() {
  const cls = getActive();
  if (!cls) return;
  document.getElementById('editorTitle').textContent = cls.name || 'Class Baru';
  document.getElementById('clsName').value = cls.name;

  // Parent selector
  const sel = document.getElementById('clsParent');
  sel.innerHTML = '<option value="">— Tidak ada —</option>';
  classes.filter(c => c.id !== cls.id).forEach(c => {
    const opt = document.createElement('option');
    opt.value = c.id;
    opt.textContent = c.name || '(tanpa nama)';
    opt.selected = c.id === cls.parentId;
    sel.appendChild(opt);
  });

  // Attrs
  const attrList = document.getElementById('attrList');
  attrList.innerHTML = '';
  cls.attrs.forEach((a, i) => {
    const row = document.createElement('div');
    row.className = 'attr-row';
    row.innerHTML = `
      <span class="vis-badge ${a.vis}" title="Klik untuk ganti visibilitas" onclick="cycleVis('attr',${i})">${a.vis==='pub'?'+':a.vis==='pro'?'#':'-'}</span>
      <input class="mini-input" placeholder="namaAtribut" value="${escHtml(a.name)}"
        oninput="updateField('attr',${i},'name',this.value)">
      <span class="colon">:</span>
      <input class="type-input" placeholder="tipe" value="${escHtml(a.type)}"
        oninput="updateField('attr',${i},'type',this.value)">
      <button class="btn-del-row" onclick="delField('attr',${i})">×</button>`;
    attrList.appendChild(row);
  });

  // Meths
  const methList = document.getElementById('methList');
  methList.innerHTML = '';
  cls.meths.forEach((m, i) => {
    const row = document.createElement('div');
    row.className = 'meth-row';
    row.innerHTML = `
      <span class="vis-badge ${m.vis}" title="Klik untuk ganti visibilitas" onclick="cycleVis('meth',${i})">${m.vis==='pub'?'+':m.vis==='pro'?'#':'-'}</span>
      <input class="mini-input" placeholder="namaMethod" value="${escHtml(m.name)}"
        oninput="updateField('meth',${i},'name',this.value)">
      <span class="colon">(</span>
      <input class="mini-input" placeholder="param, ..." style="max-width:80px;" value="${escHtml(m.params)}"
        oninput="updateField('meth',${i},'params',this.value)">
      <span class="ret-sep">)</span>
      <span class="colon">→</span>
      <input class="type-input" placeholder="tipe" value="${escHtml(m.ret)}"
        oninput="updateField('meth',${i},'ret',this.value)">
      <button class="btn-del-row" onclick="delField('meth',${i})">×</button>`;
    methList.appendChild(row);
  });
}

function escHtml(s){ return (s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

/* ══════════════════════════════════════════════════════════════
   FIELD OPERATIONS
══════════════════════════════════════════════════════════════ */
function addAttr() { getActive().attrs.push(newAttr()); renderEditor(); renderDiagram(); renderCodePreview(); }
function addMeth() { getActive().meths.push(newMeth()); renderEditor(); renderDiagram(); renderCodePreview(); }

function delField(type, i) {
  const cls = getActive();
  if (type==='attr') cls.attrs.splice(i,1); else cls.meths.splice(i,1);
  renderEditor(); renderDiagram(); renderCodePreview();
}

function updateField(type, i, key, val) {
  const cls = getActive();
  if (type==='attr') cls.attrs[i][key] = val; else cls.meths[i][key] = val;
  renderDiagram(); renderCodePreview();
}

function cycleVis(type, i) {
  const order = ['pub','pro','priv'];
  const cls = getActive();
  const arr = type==='attr' ? cls.attrs : cls.meths;
  arr[i].vis = order[(order.indexOf(arr[i].vis)+1) % 3];
  renderEditor(); renderDiagram(); renderCodePreview();
}

// Listen name + parent changes
document.getElementById('clsName').addEventListener('input', e => {
  const cls = getActive(); if (!cls) return;
  cls.name = e.target.value;
  document.getElementById('editorTitle').textContent = cls.name || 'Class Baru';
  renderTabs(); renderDiagram(); renderCodePreview();
});
document.getElementById('clsParent').addEventListener('change', e => {
  const cls = getActive(); if (!cls) return;
  cls.parentId = e.target.value || null;
  renderDiagram(); renderCodePreview();
});

/* ══════════════════════════════════════════════════════════════
   SVG DIAGRAM GENERATOR
══════════════════════════════════════════════════════════════ */
function buildDiagramSVG(classList) {
  if (!classList.length) return '';
  const BOX_W = 170, GAP_X = 40, GAP_Y = 70;
  const classMap = {}; classList.forEach(c => classMap[c.name || c.id] = c);

  // Rank (topological)
  const rank = {};
  classList.forEach(c => {
    const pName = classList.find(x => x.id === (c.parentId||c.parent))?.name;
    if (!pName || !classMap[pName]) rank[c.name||c.id] = 0;
  });
  for (let pass=0; pass<8; pass++) classList.forEach(c => {
    const pName = classList.find(x => x.id === (c.parentId||c.parent))?.name;
    if (pName && classMap[pName]) {
      const r = (rank[pName]??0)+1;
      if ((rank[c.name||c.id]??0) < r) rank[c.name||c.id] = r;
    }
  });
  classList.forEach(c => { if (rank[c.name||c.id]===undefined) rank[c.name||c.id]=0; });

  const byRank = {};
  classList.forEach(c => { const r=rank[c.name||c.id]||0; (byRank[r]=byRank[r]||[]).push(c); });
  const maxRank = Math.max(...Object.keys(byRank).map(Number));
  const maxCols = Math.max(...Object.values(byRank).map(a=>a.length));
  const svgW = Math.max(280, maxCols*(BOX_W+GAP_X)+GAP_X);

  // Box heights
  const bh = {};
  classList.forEach(c => {
    const attrRows = (c.attrs||[]).length;
    const methRows = (c.meths||[]).filter(m=>m.name!=='__init__').length;
    bh[c.name||c.id] = 36 + Math.max(0, attrRows+methRows)*16 + (attrRows>0&&methRows>0?8:0) + 12;
    bh[c.name||c.id] = Math.max(bh[c.name||c.id], 60);
  });

  // Positions
  const pos = {};
  Object.entries(byRank).forEach(([r, rcs]) => {
    const totalW = rcs.length*BOX_W + (rcs.length-1)*GAP_X;
    const startX = (svgW-totalW)/2;
    rcs.forEach((c,i) => pos[c.name||c.id] = { x: startX+i*(BOX_W+GAP_X), y: parseInt(r)*150+16 });
  });

  const svgH = (maxRank+1)*150+30;
  let svg = `<svg viewBox="0 0 ${svgW} ${svgH}" width="${svgW}" style="max-width:100%;overflow:visible;">
  <defs>
    <marker id="inh" markerWidth="9" markerHeight="9" refX="4.5" refY="4.5" orient="auto">
      <path d="M0,0 L9,4.5 L0,9 Z" fill="var(--violet)"/>
    </marker>
    <marker id="inhC" markerWidth="9" markerHeight="9" refX="4.5" refY="4.5" orient="auto">
      <path d="M0,0 L9,4.5 L0,9 Z" fill="var(--cyan)"/>
    </marker>
  </defs>`;

  // Arrows (behind)
  classList.forEach(c => {
    const pName = classList.find(x => x.id===(c.parentId||c.parent))?.name;
    if (pName && pos[c.name||c.id] && pos[pName]) {
      const from=pos[c.name||c.id], to=pos[pName];
      const fx=from.x+BOX_W/2, fy=from.y, tx=to.x+BOX_W/2, ty=to.y+bh[pName];
      svg+=`<line x1="${fx}" y1="${fy}" x2="${tx}" y2="${ty}" stroke="var(--violet)" stroke-width="1.5" marker-end="url(#inh)"/>`;
    }
  });

  // Boxes
  classList.forEach(c => {
    const key = c.name||c.id;
    if (!pos[key]) return;
    const {x,y} = pos[key], h = bh[key];
    const isParent = classList.some(oc => classList.find(x=>x.id===(oc.parentId||oc.parent))?.name===key);
    const hasParent = !!classList.find(x=>x.id===(c.parentId||c.parent));
    const stroke = hasParent ? 'var(--violet)' : isParent ? 'var(--cyan)' : 'var(--faint)';
    const isEmpty = !c.name;

    // Blueprint style for empty/draft
    const dashArr = isEmpty ? 'stroke-dasharray="6 3"' : '';
    svg+=`<rect x="${x}" y="${y}" width="${BOX_W}" height="${h}" rx="6" fill="rgba(21,24,31,0.95)" stroke="${stroke}" stroke-width="1.4" ${dashArr}/>`;

    if (isEmpty) {
      svg+=`<text x="${x+BOX_W/2}" y="${y+h/2+4}" text-anchor="middle" fill="var(--faint)" font-family="Inter" font-size="11" font-style="italic">blueprint kosong...</text>`;
    } else {
      svg+=`<text x="${x+BOX_W/2}" y="${y+20}" text-anchor="middle" fill="var(--text)" font-family="JetBrains Mono" font-size="12" font-weight="700">${escSvg(c.name)}</text>`;
      svg+=`<line x1="${x+6}" y1="${y+26}" x2="${x+BOX_W-6}" y2="${y+26}" stroke="var(--border)" stroke-width="1"/>`;
      let ly = y+40;
      (c.attrs||[]).forEach(a => {
        const col = a.vis==='priv'?'var(--rose)':a.vis==='pro'?'var(--amber)':'var(--green)';
        const pre = a.vis==='priv'?'-':a.vis==='pro'?'#':'+';
        const prefix = a.vis==='priv'?'__':a.vis==='pro'?'_':'';
        const label = `${pre} ${prefix}${a.name||'?'}${a.type?': '+a.type:''}`;
        svg+=`<text x="${x+7}" y="${ly}" fill="${col}" font-family="JetBrains Mono" font-size="9.5">${escSvg(label)}</text>`;
        ly+=16;
      });
      if ((c.attrs||[]).length && (c.meths||[]).length) {
        svg+=`<line x1="${x+6}" y1="${ly}" x2="${x+BOX_W-6}" y2="${ly}" stroke="var(--border2)" stroke-width="1"/>`;
        ly+=10;
      }
      (c.meths||[]).forEach(m => {
        const col = m.vis==='priv'?'var(--rose)':m.vis==='pro'?'var(--amber)':'var(--cyan)';
        const pre = m.vis==='priv'?'-':m.vis==='pro'?'#':'+';
        const label = `${pre} ${m.name||'?'}(${m.params||''})${m.ret?' → '+m.ret:''}`;
        svg+=`<text x="${x+7}" y="${ly}" fill="${col}" font-family="JetBrains Mono" font-size="9.5">${escSvg(label)}</text>`;
        ly+=16;
      });
    }
  });

  svg+='</svg>';
  return svg;
}

function escSvg(s) { return (s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

function renderDiagram() {
  document.getElementById('diagramWrap').innerHTML = buildDiagramSVG(classes);
}
function renderMiniDiagram() {
  document.getElementById('miniDiagram').innerHTML = buildDiagramSVG(classes);
}

/* ══════════════════════════════════════════════════════════════
   CODE GENERATOR (Blueprint → Python)
══════════════════════════════════════════════════════════════ */
function generateCode() {
  // Topological sort: parents first
  const sorted = topSort(classes);
  let code = '';

  sorted.forEach(cls => {
    const parent = classes.find(c => c.id === cls.parentId);
    const baseStr = parent?.name ? `(${parent.name})` : '';
    const cName = cls.name || 'NamaClass';
    code += `class ${cName}${baseStr}:\n`;

    // Collect params for __init__
    const ownAttrs = cls.attrs.filter(a => a.name);
    const parentAttrs = parent ? parent.attrs.filter(a => a.name) : [];

    // __init__ signature
    const allParams = [...parentAttrs.map(a=>a.name), ...ownAttrs.map(a=>a.name)];
    const paramStr = allParams.length ? ', ' + allParams.join(', ') : '';
    code += `    def __init__(self${paramStr}):\n`;

    if (parent?.name) {
      const pParams = parentAttrs.map(a=>a.name).join(', ');
      code += `        super().__init__(${pParams})\n`;
    }

    if (!ownAttrs.length && !parent) {
      code += `        pass\n`;
    }
    ownAttrs.forEach(a => {
      const prefix = a.vis==='priv'?'__':a.vis==='pro'?'_':'';
      code += `        self.${prefix}${a.name} = ${a.name}\n`;
    });
    code += '\n';

    // Other methods
    cls.meths.filter(m => m.name).forEach(m => {
      const pStr = m.params ? ', '+m.params.split(',').map(p=>p.trim()).filter(Boolean).join(', ') : '';
      const retStr = m.ret ? ` -> ${m.ret}` : '';
      code += `    def ${m.name}(self${pStr})${retStr}:\n`;
      code += `        # TODO: isi logika method ${m.name}\n`;
      code += `        pass\n\n`;
    });

    if (!cls.meths.length && !ownAttrs.length && parent) code += '';
    code += '\n';
  });

  // Instantiation example
  const last = sorted[sorted.length - 1];
  if (last?.name) {
    const parent = classes.find(c => c.id === last.parentId);
    const parentAttrs = parent ? parent.attrs.filter(a=>a.name) : [];
    const ownAttrs = last.attrs.filter(a=>a.name);
    const allA = [...parentAttrs, ...ownAttrs];
    const args = allA.map(a => a.type==='int'?'0':a.type==='float'?'0.0':a.type==='bool'?'True':`"${a.name}"`).join(', ');
    const varName = last.name.charAt(0).toLowerCase() + last.name.slice(1) + '1';
    code += `# ── Contoh penggunaan ─────────────────────────\n`;
    code += `${varName} = ${last.name}(${args})\n`;
    if (last.attrs.length) {
      const firstAttr = last.attrs[0];
      const prefix = firstAttr.vis==='priv'?'__':firstAttr.vis==='pro'?'_':'';
      if (firstAttr.vis !== 'priv') {
        code += `print(${varName}.${prefix}${firstAttr.name})\n`;
      } else {
        // Need getter
        const getter = last.meths.find(m=>m.name.startsWith('get'));
        if (getter?.name) code += `print(${varName}.${getter.name}())\n`;
        else code += `# Catatan: ${prefix}${firstAttr.name} bersifat privat, akses lewat method getter\n`;
      }
    }
  }

  return code;
}

function topSort(cls) {
  const sorted = [], visited = new Set();
  function visit(c) {
    if (visited.has(c.id)) return;
    visited.add(c.id);
    const parent = cls.find(x => x.id === c.parentId);
    if (parent) visit(parent);
    sorted.push(c);
  }
  cls.forEach(visit);
  return sorted;
}

/* ══════════════════════════════════════════════════════════════
   CODE PREVIEW (highlighted, in Phase 1)
══════════════════════════════════════════════════════════════ */
function renderCodePreview() {
  const code = generateCode();
  const box = document.getElementById('codePreview');
  box.innerHTML = hlCode(code);
}

function hlCode(code) {
  return code.split('\n').map(line => {
    let s = line.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    s = s.replace(/(#.*)$/, m=>`<span class="cm-c">${m}</span>`);
    if (s.includes('cm-c')) return s + '\n';
    s = s.replace(/"[^"]*"|'[^']*'/g, m=>`<span class="st-c">${m}</span>`);
    s = s.replace(/\b(class|def|self|super|return|pass|import|from|as|try|except|if|else|elif|for|while|in|not|and|or|True|False|None)\b/g,
      m=>`<span class="kw">${m}</span>`);
    s = s.replace(/\b(print|len|range|str|int|float|bool|isinstance)\b/g,m=>`<span class="fn-c">${m}</span>`);
    s = s.replace(/(self\.__\w+)/g,m=>`<span class="priv-c">${m}</span>`);
    return s;
  }).join('\n');
}

function resetCode() {
  document.getElementById('codeEditor').value = generateCode();
}

function goToCodeEditor() {
  if (!classes.some(c => c.name)) {
    alert('Beri nama setidaknya satu class terlebih dahulu!');
    return;
  }
  goPhase(2);
}

/* ══════════════════════════════════════════════════════════════
   PYODIDE — TRACER
══════════════════════════════════════════════════════════════ */
const TRACER = `
import sys, io, json, traceback as _tb, ast as _ast

def _objs(frame):
    skip = {'int','str','float','bool','list','dict','tuple','set','frozenset',
            'NoneType','type','function','module','builtin_function_or_method',
            'method-wrapper','wrapper_descriptor','method_descriptor',
            'classmethod','staticmethod','property','mappingproxy'}
    objs = {}
    scope = {**{k:v for k,v in frame.f_globals.items() if not k.startswith('__')},
             **{k:v for k,v in frame.f_locals.items() if not k.startswith('__')}}
    for name, val in scope.items():
        tp = type(val)
        if tp.__name__ in skip or tp is type or not hasattr(val,'__dict__'): continue
        raw = val.__dict__; clean = {}
        for k, v in raw.items():
            if k.startswith('__'): continue
            disp, priv = k, False
            mangle = '_'+tp.__name__+'__'
            if k.startswith(mangle): disp='__'+k[len(mangle):]; priv=True
            try: clean[disp]={'val':repr(v),'priv':priv,'inh':False}
            except: clean[disp]={'val':'?','priv':priv,'inh':False}
        objs[name]={'type':tp.__name__,'attrs':clean}
    return objs

def _cls(code):
    try:
        tree=_ast.parse(code); out=[]
        for n in tree.body:
            if isinstance(n,_ast.ClassDef):
                bases=[b.id for b in n.bases if isinstance(b,_ast.Name)]
                attrs,meths=[],[]
                for item in n.body:
                    if isinstance(item,_ast.FunctionDef):
                        meths.append(item.name)
                        if item.name=='__init__':
                            for s in _ast.walk(item):
                                if isinstance(s,_ast.Assign):
                                    for t in s.targets:
                                        if isinstance(t,_ast.Attribute) and isinstance(t.value,_ast.Name) and t.value.id=='self':
                                            attrs.append(t.attr)
                out.append({'name':n.name,'bases':bases,'attrs':attrs,'meths':meths,'parentId':None,'id':n.name})
        return out
    except: return []

def _run(code):
    steps=[]; ci=_cls(code)
    # Mark inherited attrs
    def mark_inh(objs):
        parent_attrs={}
        for c in ci:
            if c['bases']:
                parent_attrs[c['name']]=set()
                for b in c['bases']:
                    for oc in ci:
                        if oc['name']==b:
                            for a in oc['attrs']: parent_attrs[c['name']].add(a.lstrip('_'))
        for obj in objs.values():
            if obj['type'] in parent_attrs:
                for k in obj['attrs']:
                    if k.lstrip('_') in parent_attrs[obj['type']]: obj['attrs'][k]['inh']=True
        return objs
    buf=io.StringIO(); old=sys.stdout; sys.stdout=buf; ns={}; MAX=120
    def tr(frame,event,arg):
        if frame.f_code.co_filename!='<ics>': return tr
        if event=='line':
            if len(steps)>=MAX: raise RuntimeError(f'Batas {MAX} langkah tercapai.')
            o=buf.getvalue(); ob=mark_inh(_objs(frame))
            steps.append({'line':frame.f_lineno,'output':o,'objects':ob,'frame':frame.f_code.co_name,'error':None})
        return tr
    err=None
    try:
        sys.settrace(tr)
        exec(compile(code,'<ics>','exec'),ns)
    except Exception as e:
        o=buf.getvalue(); tbl=_tb.extract_tb(sys.exc_info()[2]); ln=-1
        for f in reversed(tbl):
            if f.filename=='<ics>': ln=f.lineno; break
        err={'line':ln,'output':o,'objects':{},'frame':'<error>','error':type(e).__name__+': '+str(e)}
    finally:
        sys.settrace(None); sys.stdout=old
    if err: steps.append(err)
    return json.dumps({'steps':steps,'classes':ci})
`;

async function initPy() {
  try {
    pyodide = await loadPyodide();
    await pyodide.runPythonAsync(TRACER);
    const el = document.getElementById('pyStatusGlobal');
    el.textContent = 'Python siap ✓';
    el.className = 'py-status ready';
    document.getElementById('btnJalankan').disabled = false;
  } catch(e) {
    document.getElementById('pyStatusGlobal').textContent = 'Python gagal dimuat';
    console.error(e);
  }
}

/* ══════════════════════════════════════════════════════════════
   RUN SIMULATION
══════════════════════════════════════════════════════════════ */
async function jalankanSimulasi() {
  const code = document.getElementById('codeEditor').value.trim();
  if (!code) return;
  predInitial = document.getElementById('predAwal').value.trim();

  // Validasi server (Laravel)
  const loaderRow = document.getElementById('loaderRow');
  const errDiv = document.getElementById('runError');
  loaderRow.classList.add('show');
  errDiv.style.display = 'none';
  document.getElementById('btnJalankan').disabled = true;
  document.getElementById('loaderMsg').textContent = 'Memeriksa kode...';

  try {
    const resp = await fetch('{{ route("simulasi.jalankan") }}', {
      method: 'POST',
      headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': window.CSRF },
      body: JSON.stringify({ kode_python: code })
    });
    const check = await resp.json();
    if (!check.boleh) throw new Error(check.pesan);

    document.getElementById('loaderMsg').textContent = 'Mengeksekusi Python...';
    pyodide.globals.set('_ics_code', code);
    const result = await pyodide.runPythonAsync('_run(_ics_code)');
    const data = JSON.parse(result);

    if (!data.steps.length) throw new Error('Tidak ada langkah dihasilkan. Pastikan kode memiliki statement eksekusi (bukan hanya definisi class).');

    traceSteps = data.steps;
    traceClasses = data.classes;
    codeLines = code.split('\n');
    stepIdx = 0; predAnswered = {};

    // Auto predict flags
    const errIdx = traceSteps.findIndex(s=>s.error);
    if (errIdx>0 && !traceSteps[errIdx-1].predict)
      traceSteps[errIdx-1].predict = 'Perhatikan baris berikutnya. Apa yang kamu prediksi akan terjadi?';
    const objIdx = traceSteps.findIndex(s=>Object.keys(s.objects||{}).length>0);
    if (objIdx>0 && !traceSteps[objIdx-1].predict)
      traceSteps[objIdx-1].predict = 'Baris berikutnya akan membuat objek di memori. Atribut apa saja yang akan dimiliki objek tersebut?';

    document.getElementById('simTitle').textContent = 'Simulasi: ' + (traceClasses.map(c=>c.name).join(', ') || 'kode kustom');
    document.getElementById('simSubtitle').textContent = `${traceSteps.length} langkah · Python 3 (Pyodide)`;

    goPhase(3);
    renderSim();
  } catch(e) {
    errDiv.textContent = '⚠ ' + e.message;
    errDiv.style.display = 'block';
  } finally {
    loaderRow.classList.remove('show');
    document.getElementById('btnJalankan').disabled = false;
  }
}

/* ══════════════════════════════════════════════════════════════
   SIMULATION RENDER
══════════════════════════════════════════════════════════════ */
function hlLine(line) {
  let s = line.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  s = s.replace(/(#.*)$/, m=>`<span style="color:var(--faint);font-style:italic;">${m}</span>`);
  if (s.includes('font-style')) return s;
  s = s.replace(/"[^"]*"|'[^']*'/g, m=>`<span style="color:var(--green);">${m}</span>`);
  s = s.replace(/\b(class|def|self|super|return|pass|import|from|as|try|except|if|else|elif|for|while|in|not|and|or|True|False|None)\b/g,
    m=>`<span style="color:var(--violet);">${m}</span>`);
  s = s.replace(/\b(print|len|range|str|int|float|bool)\b/g,m=>`<span style="color:var(--cyan);">${m}</span>`);
  s = s.replace(/(self\.__\w+)/g,m=>`<span style="color:var(--rose);">${m}</span>`);
  return s;
}

function narr(step) {
  if (step.error) {
    const [et,...rest]=step.error.split(': ');
    return `<span style="color:var(--rose)"><b>${et}</b></span>: ${rest.join(': ')} — Python menolak operasi ini karena melanggar aturan bahasa.`;
  }
  const raw=(codeLines[step.line-1]||'').trim(), fr=step.frame;
  if (!raw) return `Python berada di baris ${step.line}.`;
  if (raw.startsWith('class ')) {
    const cn=raw.replace('class ','').replace(':','').split('(')[0].trim();
    const base=raw.match(/\((\w+)\)/)?.[1];
    return base?`Python membaca definisi <b>class ${cn}</b> yang mewarisi <b>${base}</b>.`:`Python membaca definisi <b>class ${cn}</b> sebagai blueprint untuk membuat objek.`;
  }
  if (raw.startsWith('def ')) return `Python mendefinisikan method <b>${raw.match(/def\s+(\w+)/)?.[1]||''}()</b>.`;
  if (raw.includes('super().__init__')) return `<b>super().__init__()</b> dipanggil — Python berpindah ke constructor class induk untuk mewarisi atribut.`;
  if (raw.match(/self\.__\w+\s*=/)) {
    const a=raw.match(/self\.(__\w+)/)?.[1]||'';
    return `Atribut privat <b>${a}</b> diset. Awalan <code>__</code> membuat atribut ini hanya bisa diakses dari dalam class.`;
  }
  if (raw.match(/self\._\w+\s*=/)&&!raw.match(/self\.__/)) {
    const a=raw.match(/self\.(_\w+)/)?.[1]||'';
    return `Atribut protected <b>${a}</b> diset — dapat diakses dari class dan subclass.`;
  }
  if (raw.match(/self\.\w+\s*=/)) {
    const a=raw.match(/self\.(\w+)/)?.[1]||'';
    return `Atribut publik <b>${a}</b> diset pada objek.`;
  }
  if (raw.match(/^\w+\s*=\s*\w+\(/)&&fr==='<module>') {
    const vn=raw.split('=')[0].trim(), cn=raw.match(/=\s*(\w+)\(/)?.[1]||'';
    return `Python membuat objek baru dari class <b>${cn}</b> dan menyimpannya ke variabel <b>${vn}</b>.`;
  }
  if (raw.includes('print(')) return `Python menjalankan <b>print()</b> — hasilnya muncul di console.`;
  if (raw.includes('return ')) return `Method <b>${fr}()</b> mengembalikan nilai ke pemanggil.`;
  if (fr&&fr!=='<module>'&&fr!=='<error>') return `Eksekusi berada di dalam method <b>${fr}()</b>.`;
  return `Python mengeksekusi: <code>${raw.replace(/</g,'&lt;')}</code>`;
}

function renderSim() {
  const step = traceSteps[stepIdx];
  const isLast = stepIdx===traceSteps.length-1;

  // Code viewer
  const viewer = document.getElementById('codeViewer');
  viewer.innerHTML = '';
  codeLines.forEach((line,i) => {
    const div=document.createElement('div');
    const isA=(i+1)===step.line, isE=step.error&&isA;
    div.className='cl'+(isE?' error-line':isA?' active':'');
    div.innerHTML=`<span class="ln">${i+1}</span><span class="ct">${hlLine(line)||'&nbsp;'}</span>`;
    viewer.appendChild(div);
  });
  const ae=viewer.querySelector('.active,.error-line');
  if(ae) ae.scrollIntoView({block:'nearest',behavior:'smooth'});

  // Frame badge
  document.getElementById('frameBadge').textContent=step.frame==='<module>'?'modul':step.frame==='<error>'?'error':step.frame+'()';

  // Objects
  const obBody=document.getElementById('objBody');
  const objs=step.objects||{};
  const names=Object.keys(objs);
  if(!names.length){obBody.innerHTML='<div style="font-family:var(--mono);font-size:12px;color:var(--faint);border:1px dashed var(--border);border-radius:8px;padding:16px;text-align:center;">Belum ada objek di memori</div>';}
  else{
    obBody.innerHTML='';
    const row=document.createElement('div');
    row.style.cssText='display:flex;flex-wrap:wrap;gap:10px;';
    names.forEach(name=>{
      const obj=objs[name];
      const card=document.createElement('div');
      card.className='obj-card';
      if(step.error)card.style.borderColor='var(--rose)';
      let rows='';
      Object.entries(obj.attrs||{}).forEach(([k,v])=>{
        const lock=v.priv?'<span class="pbadge">privat</span>':'';
        const inh=v.inh?'<span class="ibadge">diwariskan</span>':'';
        rows+=`<div class="arow"><span class="akey">${escHtml(k)} ${lock}${inh}</span><span class="aval">${escHtml(v.val)}</span></div>`;
      });
      if(!rows)rows='<div class="arow"><span class="akey" style="color:var(--faint)">(kosong)</span></div>';
      card.innerHTML=`<div class="obj-title">${escHtml(name)} <span class="oty">: ${escHtml(obj.type)}</span></div>${rows}`;
      row.appendChild(card);
    });
    obBody.appendChild(row);
  }

  // Console
  const con=document.getElementById('consBody');
  const out=(step.output||'').trimEnd();
  const err=step.error||'';
  if(!out&&!err){con.innerHTML='<div class="cempty">(belum ada output)</div>';}
  else{
    con.innerHTML='';
    if(out) out.split('\n').forEach(l=>{const d=document.createElement('div');d.className='cline cok';d.textContent='> '+l;con.appendChild(d);});
    if(err){const d=document.createElement('div');d.className='cline cerr';d.textContent='✕ '+err;con.appendChild(d);}
  }

  // Narration
  document.getElementById('narr').innerHTML='<b>Yang terjadi:</b> '+narr(step);

  // Predict
  const pkey='s'+stepIdx;
  const pb=document.getElementById('predSimBox');
  if(step.predict&&!predAnswered[pkey]){
    pb.style.display='block';
    document.getElementById('predSimQ').textContent=step.predict;
    document.getElementById('predSimIn').value='';
    document.getElementById('predSimResult').style.display='none';
  } else pb.style.display='none';

  // Reflect
  const rb=document.getElementById('reflBox');
  if(isLast){
    rb.style.display='block';
    const hasErr=traceSteps.some(s=>s.error);
    const hasInh=traceSteps.some(s=>Object.values(s.objects||{}).some(o=>Object.values(o.attrs||{}).some(a=>a.inh)));
    const hasPriv=traceSteps.some(s=>Object.values(s.objects||{}).some(o=>Object.values(o.attrs||{}).some(a=>a.priv)));
    let rq='Apa yang paling kamu pelajari dari simulasi ini?';
    if(hasInh) rq='Bagaimana mekanisme pewarisan (inheritance) bekerja dalam simulasi ini? Apa yang berubah dari pemahamanmu sebelumnya?';
    if(hasPriv) rq='Mengapa Python memiliki konsep atribut privat (__)? Berikan argumenmu berdasarkan apa yang kamu amati.';
    if(hasErr) rq='Error yang terjadi dalam simulasi ini mengajarkan apa tentang cara Python menjaga aturan akses atribut?';
    document.getElementById('reflQ').textContent=rq;
  } else rb.style.display='none';

  // Timeline
  const tl=document.getElementById('tl');
  tl.innerHTML='';
  traceSteps.forEach((s,i)=>{
    const n=document.createElement('div');
    n.className='tn'+(i<stepIdx?' done':'')+(i===stepIdx?' cur':'')+(s.error?' err':'');
    n.title=`Langkah ${i+1}${s.error?' (error)':''}`;
    n.onclick=()=>{stepIdx=i;renderSim();};
    tl.appendChild(n);
    if(i<traceSteps.length-1){const l=document.createElement('div');l.className='tl-line'+(i<stepIdx?' done':'');tl.appendChild(l);}
  });

  // Controls
  document.getElementById('btnPrev').disabled=stepIdx===0;
  document.getElementById('btnNext').disabled=stepIdx===traceSteps.length-1;
  document.getElementById('stepInfo').textContent=`Langkah ${stepIdx+1} / ${traceSteps.length}`;
}

function checkPred(){
  const key='s'+stepIdx;
  const val=document.getElementById('predSimIn').value.trim()||'(tidak diisi)';
  predAnswered[key]=val;
  const res=document.getElementById('predSimResult');
  res.innerHTML=`<span style="color:var(--faint);">Prediksimu:</span> <span style="color:var(--text);">${escHtml(val)}</span><br><span style="color:var(--faint);">→ Tekan › untuk melihat apa yang terjadi.</span>`;
  res.style.display='block';
}

function resetSim(){stepIdx=0;renderSim();}
function simpanRefleksi(){window.showToast('Refleksi tersimpan ✓','success');}

// Keyboard nav
document.addEventListener('keydown',e=>{
  if(!document.getElementById('phase3') || document.getElementById('phase3').style.display==='none') return;
  if(e.target.tagName==='INPUT'||e.target.tagName==='TEXTAREA') return;
  if(e.key==='ArrowRight') document.getElementById('btnNext').click();
  if(e.key==='ArrowLeft') document.getElementById('btnPrev').click();
});

document.getElementById('btnPrev').onclick=()=>{if(stepIdx>0){stepIdx--;renderSim();}};
document.getElementById('btnNext').onclick=()=>{if(stepIdx<traceSteps.length-1){stepIdx++;renderSim();}};

// Toggle diagram in sim
document.getElementById('btnToggleDiag').onclick=function(){
  diagVisible=!diagVisible;
  document.getElementById('simDiagBody').style.display=diagVisible?'':'none';
  this.textContent=diagVisible?'Sembunyikan':'Tampilkan';
};

/* ══════════════════════════════════════════════════════════════
   BOOT
══════════════════════════════════════════════════════════════ */
// Init default class with example attrs
classes[0].attrs = [
  {id:'a1',vis:'pro',name:'merek',type:'str'},
];
classes[0].meths = [];

// Add second class (Motor inherits Kendaraan) as example
const motor = newClass('Motor');
motor.parentId = classes[0].id;
motor.attrs = [{id:'a2',vis:'pub',name:'jenis_motor',type:'str'}];
motor.meths = [{id:'m1',vis:'pub',name:'info',params:'',ret:'str'}];
classes.push(motor);
activeId = motor.id;

renderTabs();
renderEditor();
renderDiagram();
renderCodePreview();

// Start Pyodide
document.getElementById('btnJalankan').disabled = true;
initPy();
</script>
@endpush
