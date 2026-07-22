<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'ICS') — Simulasi Kode Interaktif</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0e1014;--panel:#15181f;--panel2:#1b1f29;--border:#262b38;--border2:#1e222d;
  --text:#e8eaf0;--dim:#8d96ab;--faint:#545b6e;
  --amber:#ffb454;--amber-bg:rgba(255,180,84,.09);--amber-dim:#3a2a12;
  --cyan:#6ad6e8;--violet:#b794f6;--rose:#ff7a8a;--rose-bg:rgba(255,122,138,.08);
  --green:#7ee08a;--green-bg:rgba(126,224,138,.08);
  --r:10px;--mono:'JetBrains Mono',monospace;--sans:'Inter',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{background:var(--bg);color:var(--text);font-family:var(--sans);-webkit-font-smoothing:antialiased;min-height:100vh;}
a{color:var(--cyan);text-decoration:none;}
a:hover{text-decoration:underline;}
input,textarea,select{font-family:var(--sans);}

/* nav */
nav.main-nav{
  display:flex;align-items:center;gap:14px;padding:0 24px;height:52px;
  border-bottom:1px solid var(--border);background:var(--panel);
  position:sticky;top:0;z-index:100;
}
.nav-brand{display:flex;align-items:center;gap:10px;}
.nav-mark{width:30px;height:30px;border-radius:7px;background:linear-gradient(145deg,var(--amber),#ff8a40);
  display:flex;align-items:center;justify-content:center;font-family:var(--mono);font-weight:700;
  color:#1a0e00;font-size:12px;flex-shrink:0;}
.nav-title{font-size:13.5px;font-weight:600;}
.nav-links{display:flex;gap:4px;margin-left:16px;}
.nav-link{font-size:12.5px;color:var(--dim);padding:5px 10px;border-radius:6px;transition:.15s;}
.nav-link:hover,.nav-link.active{background:var(--panel2);color:var(--text);text-decoration:none;}
.nav-right{margin-left:auto;display:flex;align-items:center;gap:10px;}
.py-status{font-family:var(--mono);font-size:11px;padding:4px 10px;border-radius:6px;
  border:1px solid var(--border);color:var(--faint);}
.py-status.ready{border-color:var(--green);color:var(--green);}
.py-status.loading{border-color:var(--amber);color:var(--amber);}

/* main content */
.content{max-width:1280px;margin:0 auto;padding:24px 20px 80px;}

/* toast */
#toast{
  position:fixed;bottom:24px;right:24px;z-index:999;display:none;
  background:var(--panel);border:1px solid var(--border);border-radius:10px;
  padding:12px 18px;font-size:13px;box-shadow:0 4px 24px rgba(0,0,0,.4);max-width:320px;
}
#toast.success{border-color:var(--green);color:var(--green);}
#toast.error{border-color:var(--rose);color:var(--rose);}
</style>
@stack('styles')
</head>
<body>

<nav class="main-nav">
  <div class="nav-brand">
    <div class="nav-mark">&gt;_</div>
    <span class="nav-title">ICS · Simulasi Kode Interaktif</span>
  </div>
  <div class="nav-links">
    <a href="{{ route('blueprint.builder') }}" class="nav-link {{ request()->routeIs('blueprint.*') ? 'active' : '' }}">Blueprint Builder</a>
    <a href="{{ route('simulasi.index') }}" class="nav-link {{ request()->routeIs('simulasi.*') ? 'active' : '' }}">Skenario</a>
  </div>
  <div class="nav-right">
    <span class="py-status loading" id="pyStatusGlobal">Memuat Python…</span>
  </div>
</nav>

<div class="content">
  @yield('content')
</div>

<div id="toast"></div>

<script>
// Global toast helper
window.showToast = (msg, type='success', ms=3000) => {
  const t = document.getElementById('toast');
  t.textContent = msg; t.className = type; t.style.display = 'block';
  setTimeout(() => t.style.display = 'none', ms);
};
// Global CSRF
window.CSRF = document.querySelector('meta[name="csrf-token"]').content;
</script>

@stack('scripts')
</body>
</html>
