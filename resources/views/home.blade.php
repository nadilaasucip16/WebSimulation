@extends('layouts.app')
@section('title', 'Beranda')

@push('styles')
<style>
#pyStatusGlobal{display:none;}
.home-hero{text-align:center;padding:48px 0 36px;}
.home-hero h1{font-size:26px;font-weight:700;margin-bottom:10px;line-height:1.35;}
.home-hero p{font-size:14px;color:var(--dim);line-height:1.7;max-width:520px;margin:0 auto;}
.konsep-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:32px;}
@media(max-width:700px){.konsep-grid{grid-template-columns:1fr;}}
.konsep-card{
  border-radius:14px;border:1.5px solid;padding:28px 26px 24px;
  transition:.2s ease;text-decoration:none;display:block;
}
.konsep-card:hover{transform:translateY(-3px);text-decoration:none;}
.konsep-card.enc{border-color:rgba(255,122,138,.35);background:rgba(255,122,138,.04);}
.konsep-card.enc:hover{border-color:rgba(255,122,138,.6);background:rgba(255,122,138,.08);}
.konsep-card.inh{border-color:rgba(183,148,246,.35);background:rgba(183,148,246,.04);}
.konsep-card.inh:hover{border-color:rgba(183,148,246,.6);background:rgba(183,148,246,.08);}
.kc-badge{
  display:inline-block;font-family:var(--mono);font-size:9.5px;font-weight:700;
  letter-spacing:1.1px;text-transform:uppercase;padding:3px 9px;border-radius:5px;
  border:1px solid;margin-bottom:16px;
}
.kc-badge.enc{color:var(--rose);border-color:rgba(255,122,138,.4);background:rgba(255,122,138,.09);}
.kc-badge.inh{color:var(--violet);border-color:rgba(183,148,246,.4);background:rgba(183,148,246,.09);}
.kc-icon{font-size:34px;margin-bottom:12px;line-height:1;}
.kc-title{font-size:22px;font-weight:700;margin-bottom:4px;}
.kc-title.enc{color:var(--rose);}
.kc-title.inh{color:var(--violet);}
.kc-en{font-family:var(--mono);font-size:11px;color:var(--faint);margin-bottom:14px;}
.kc-desc{font-size:13.5px;color:var(--dim);line-height:1.65;margin-bottom:18px;}
.kc-list{list-style:none;display:flex;flex-direction:column;gap:8px;margin-bottom:24px;}
.kc-list li{font-size:13px;color:var(--dim);display:flex;align-items:flex-start;gap:9px;line-height:1.5;}
.kc-list li .ck{font-size:10px;font-weight:700;flex-shrink:0;margin-top:3px;font-family:var(--mono);}
.kc-list.enc li .ck{color:var(--rose);}
.kc-list.inh li .ck{color:var(--violet);}
.kc-list li code{font-family:var(--mono);font-size:11px;background:rgba(0,0,0,.3);padding:1px 5px;border-radius:3px;}
.kc-btn{
  display:inline-flex;align-items:center;gap:7px;
  padding:10px 20px;border-radius:9px;font-size:13.5px;font-weight:600;
  border:none;cursor:pointer;transition:.15s;
}
.kc-btn.enc{background:var(--rose);color:#1a0008;}
.kc-btn.enc:hover{filter:brightness(1.08);}
.kc-btn.inh{background:var(--violet);color:#0e0720;}
.kc-btn.inh:hover{filter:brightness(1.08);}
.home-note{
  margin-top:20px;text-align:center;font-size:12.5px;color:var(--faint);
  border:1px solid var(--border);border-radius:8px;padding:12px;
}
.home-note code{font-family:var(--mono);font-size:11px;color:var(--dim);}
</style>
@endpush

@section('content')

<div class="home-hero">
  <h1>Pilih Konsep OOP yang Ingin Dipelajari</h1>
  <p>Simulasi kode Python interaktif langkah demi langkah — setiap baris dieksekusi dengan penjelasan konsep secara real-time di browser.</p>
</div>

<div class="konsep-grid">

  <!-- ── ENKAPSULASI ────────────────────────────────────── -->
  <a href="{{ route('blueprint.enkapsulasi') }}" class="konsep-card enc">
    <div class="kc-badge enc">OOP · Konsep 1</div>
    <div class="kc-icon">🔒</div>
    <div class="kc-title enc">Enkapsulasi</div>
    <div class="kc-en">Encapsulation</div>
    <div class="kc-desc">
      Menyembunyikan data internal sebuah class dari akses luar dan mengontrolnya hanya melalui method yang sudah ditentukan.
    </div>
    <ul class="kc-list enc">
      <li><span class="ck">▸</span> Atribut privat (<code>__attr</code>) dan protected (<code>_attr</code>)</li>
      <li><span class="ck">▸</span> Getter &amp; setter sebagai "pintu resmi" akses data</li>
      <li><span class="ck">▸</span> Diagram UML dengan simbol <code>-</code> privat &amp; <code>#</code> protected</li>
      <li><span class="ck">▸</span> Visualisasi name mangling Python secara langkah per langkah</li>
    </ul>
    <span class="kc-btn enc">Mulai Belajar →</span>
  </a>

  <!-- ── INHERITANCE ────────────────────────────────────── -->
  <a href="{{ route('blueprint.inheritance') }}" class="konsep-card inh">
    <div class="kc-badge inh">OOP · Konsep 2</div>
    <div class="kc-icon">📐</div>
    <div class="kc-title inh">Inheritance</div>
    <div class="kc-en">Pewarisan</div>
    <div class="kc-desc">
      Membuat class baru yang mewarisi atribut dan method dari class yang sudah ada — tanpa perlu menulis ulang dari awal.
    </div>
    <ul class="kc-list inh">
      <li><span class="ck">▸</span> Relasi <code>class Anak(Induk)</code> di Python</li>
      <li><span class="ck">▸</span> Pemanggilan <code>super().__init__()</code> untuk inisialisasi warisan</li>
      <li><span class="ck">▸</span> Diagram UML dengan panah pewarisan antar class</li>
      <li><span class="ck">▸</span> Label <em>diwariskan</em> pada atribut di panel Status Objek</li>
    </ul>
    <span class="kc-btn inh">Mulai Belajar →</span>
  </a>

</div>

<div class="home-note">
  Semua simulasi berjalan sepenuhnya di browser — tidak ada kode yang dikirim ke server. Didukung <code>Pyodide</code> (Python 3 via WebAssembly).
</div>

@endsection
