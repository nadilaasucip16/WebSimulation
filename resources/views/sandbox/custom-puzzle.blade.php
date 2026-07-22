<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🧩 Custom Puzzle – Sandbox</title>
<style>
/* ── RESET ──────────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── DESIGN TOKENS ──────────────────────────────────────────── */
:root {
    --toolbox-bg : #18222f;
    --ws-bg      : #111820;
    --header-bg  : #0d1117;
    --border     : rgba(255,255,255,.06);
    --font       : 'Consolas', 'JetBrains Mono', 'Courier New', monospace;

    /* Connector geometry */
    --bump-w: 28px;
    --bump-h: 13px;
    --bump-x: 28px;

    /* Block palette — foreground / bump-shadow / glow */
    --c-class:   #4C97FF;  --bump-class:   #2a69d4;  --glow-class:   rgba(76,151,255,.55);
    --c-attr:    #FF8C1A;  --bump-attr:    #cc6e0c;  --glow-attr:    rgba(255,140,26,.55);
    --c-method:  #59b05c;  --bump-method:  #387a3b;  --glow-method:  rgba(89,176,92,.55);
    --c-private: #9966FF;  --bump-private: #6633cc;  --glow-private: rgba(153,102,255,.55);
    --c-public:  #ffab19;  --bump-public:  #cc8812;  --glow-public:  rgba(255,171,25,.55);
    --c-inherit: #e05c5c;  --bump-inherit: #b03030;  --glow-inherit: rgba(224,92,92,.55);
}

/* ── BODY ───────────────────────────────────────────────────── */
html, body { height: 100%; overflow: hidden; }
body {
    font-family: var(--font);
    background: var(--header-bg);
    color: #c9d1d9;
    display: flex;
    flex-direction: column;
}

/* ── HEADER BAR ─────────────────────────────────────────────── */
.header {
    background: var(--header-bg);
    border-bottom: 1px solid var(--border);
    padding: 9px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
    font-size: 13px;
}
.header .title { font-weight: 600; color: #e2e8f0; letter-spacing: -.01em; }
.pill {
    font-size: 10px;
    padding: 2px 9px;
    border-radius: 20px;
    border: 1px solid;
    letter-spacing: .02em;
}
.pill-blue   { background: rgba(76,151,255,.1);  color:#60a5fa; border-color:rgba(76,151,255,.25); }
.pill-green  { background: rgba(74,222,128,.1);  color:#4ade80; border-color:rgba(74,222,128,.25); }
.pill-amber  { background: rgba(255,171,25,.1);  color:#fbbf24; border-color:rgba(255,171,25,.25); }
.header a.back {
    margin-left: auto;
    font-size: 11px;
    color: #8b949e;
    text-decoration: none;
    padding: 4px 11px;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 6px;
    transition: color .15s, border-color .15s;
}
.header a.back:hover { color: #e2e8f0; border-color: rgba(255,255,255,.25); }

/* ── MAIN 2-COLUMN LAYOUT ───────────────────────────────────── */
.main { flex: 1; display: flex; overflow: hidden; }

/* ── TOOLBOX (left column) ──────────────────────────────────── */
.toolbox {
    width: 256px;
    flex-shrink: 0;
    background: var(--toolbox-bg);
    border-right: 1px solid var(--border);
    overflow-y: auto;
    padding: 20px 16px 48px;
    /* The notch ::before on toolbox blocks should match THIS bg */
    --notch-color: var(--toolbox-bg);
}
.toolbox-section { margin-bottom: 26px; }
.toolbox-section > h4 {
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    color: rgba(255,255,255,.25);
    margin-bottom: 16px;
    padding-left: 2px;
}

/* ════════════════════════════════════════════════════════════
   PUZZLE BLOCK — core shape using ::before (notch) + ::after (bump)
   ════════════════════════════════════════════════════════════ */
.puzzle-block {
    position: relative;
    display: inline-flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 7px;

    /* Extra top padding makes room for the visible notch */
    padding: 9px 13px calc(9px) 13px;
    padding-top: calc(9px + var(--bump-h));

    border-radius: 5px;
    min-width: 216px;
    max-width: 216px;
    cursor: grab;
    user-select: none;
    color: white;

    /* Raised look: bright inner top edge + outer drop shadow */
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.24),
        inset 0 -1px 0 rgba(0,0,0,.25),
        0 3px 8px rgba(0,0,0,.5);

    transition: filter .18s ease, transform .18s ease;
    z-index: 1;

    /* Space below each block for its own bump */
    margin-bottom: calc(var(--bump-h) + 6px);
}
.puzzle-block:last-child  { margin-bottom: 0; }
.puzzle-block:active      { cursor: grabbing; }

/* ── HOVER: brightness + shape-aware glow via drop-shadow ── */
/*    drop-shadow follows the pixel mask → glow traces the
      full puzzle silhouette including the bump below          */
.puzzle-block:hover {
    filter: brightness(1.2)
            drop-shadow(0 0 10px var(--glow-color, rgba(76,151,255,.55)));
    transform: translateY(-4px) scale(1.025);
    z-index: 10;
}
.puzzle-block.is-dragging {
    opacity: 0.28;
    filter: none;
    transform: none;
}

/* ── ::before — TOP NOTCH (socket) ─────────────────────────
   A downward-curving arch in the parent's background colour
   visually "bites" a socket hole into the block's top edge.  */
.puzzle-block::before {
    content: '';
    position: absolute;
    top: 0;
    left: var(--bump-x);
    width:  var(--bump-w);
    height: var(--bump-h);
    background: var(--notch-color);         /* matches parent container */
    border-radius: 0 0 50% 50% / 0 0 100% 100%; /* ∪ arch */
    z-index: 3;
}

/* ── ::after — BOTTOM BUMP (stud) ──────────────────────────
   A downward-curving arch in the block's own colour that
   protrudes below the block's bottom edge like a puzzle peg. */
.puzzle-block::after {
    content: '';
    position: absolute;
    bottom: calc(-1 * var(--bump-h));
    left: var(--bump-x);
    width:  var(--bump-w);
    height: var(--bump-h);
    background: var(--bump-color);          /* slightly darker shade */
    border-radius: 0 0 50% 50% / 0 0 100% 100%; /* ∪ arch */
    box-shadow: inset 0 2px 0 rgba(255,255,255,.12), 0 2px 4px rgba(0,0,0,.35);
    z-index: 2;
}

/* ── BLOCK COLOR VARIANTS ────────────────────────────────── */
.block-class   { background:var(--c-class);   --bump-color:var(--bump-class);   --glow-color:var(--glow-class);   }
.block-attr    { background:var(--c-attr);    --bump-color:var(--bump-attr);    --glow-color:var(--glow-attr);    }
.block-method  { background:var(--c-method);  --bump-color:var(--bump-method);  --glow-color:var(--glow-method);  }
.block-private { background:var(--c-private); --bump-color:var(--bump-private); --glow-color:var(--glow-private); }
.block-public  { background:var(--c-public);  --bump-color:var(--bump-public);  --glow-color:var(--glow-public);  }
.block-inherit { background:var(--c-inherit); --bump-color:var(--bump-inherit); --glow-color:var(--glow-inherit); }

/* ── BLOCK INTERNALS ─────────────────────────────────────── */
.blk-kw {                               /* keyword label */
    font-size: 11.5px;
    font-weight: 700;
    color: rgba(255,255,255,.92);
    text-shadow: 0 1px 2px rgba(0,0,0,.45);
    white-space: nowrap;
    flex-shrink: 0;
}
.blk-input {
    background: rgba(0,0,0,.28);
    border: 1px solid rgba(255,255,255,.26);
    border-radius: 4px;
    color: white;
    font-family: var(--font);
    font-size: 10.5px;
    padding: 3px 8px;
    flex: 1;
    min-width: 0;
    outline: none;
    transition: border-color .15s, background .15s;
}
.blk-input:focus          { border-color: rgba(255,255,255,.65); background: rgba(0,0,0,.45); }
.blk-input::placeholder   { color: rgba(255,255,255,.32); }
.blk-select {
    background: rgba(0,0,0,.28);
    border: 1px solid rgba(255,255,255,.26);
    border-radius: 4px;
    color: white;
    font-family: var(--font);
    font-size: 10.5px;
    padding: 3px 6px;
    outline: none;
    cursor: pointer;
    flex-shrink: 0;
}
.blk-select option { background: #1e2d3d; }

/* ── WORKSPACE (right column) ────────────────────────────── */
.workspace {
    flex: 1;
    background: var(--ws-bg);
    /* Dot-grid background — subtle depth cue */
    background-image: radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
    background-size: 22px 22px;
    overflow-y: auto;
    padding: 36px 40px;
    position: relative;
    transition: background-color .2s;
    /* Workspace blocks' ::before notch must match THIS bg */
    --notch-color: var(--ws-bg);
}
.workspace.drag-over {
    background-color: #141f2e;
    outline: 2px dashed rgba(76,151,255,.3);
    outline-offset: -18px;
}

/* ── WORKSPACE HINT ─────────────────────────────────────── */
.ws-hint {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: rgba(255,255,255,.12);
    pointer-events: none;
    line-height: 2;
    font-size: 13px;
}
.ws-hint-arrow {
    display: block;
    font-size: 30px;
    margin-bottom: 8px;
    animation: float-x 2.2s ease-in-out infinite;
}
@keyframes float-x {
    0%, 100% { transform: translateX(-10px); }
    50%       { transform: translateX(10px); }
}

/* ── WORKSPACE BLOCK WRAPPER ─────────────────────────────── */
.ws-wrap { display: inline-block; }
.ws-wrap .puzzle-block {
    /* Notch uses workspace bg — inherited via --notch-color cascade */
    min-width: 230px;
    max-width: 280px;
}

/* Delete (×) button injected into each workspace block */
.blk-del {
    margin-left: auto;
    flex-shrink: 0;
    width: 16px; height: 16px;
    border: none;
    border-radius: 50%;
    background: rgba(0,0,0,.32);
    color: rgba(255,255,255,.5);
    font-size: 12px;
    line-height: 1;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background .15s, color .15s;
    padding: 0;
}
.blk-del:hover { background: rgba(239,68,68,.8); color: white; }

/* Drop-position indicator line */
.drop-indicator {
    width: 240px;
    height: 3px;
    background: linear-gradient(90deg, var(--c-class) 60%, transparent);
    border-radius: 3px;
    margin: 3px 0;
    animation: ind-pulse 0.9s ease-in-out infinite;
}
@keyframes ind-pulse { 0%,100%{opacity:.45} 50%{opacity:1} }

/* Workspace vertical stack */
.ws-stack { display: flex; flex-direction: column; align-items: flex-start; }

/* Toolbox legend */
.toolbox-legend {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 12px 16px;
    background: linear-gradient(transparent, var(--toolbox-bg) 40%);
    font-size: 9.5px;
    color: rgba(255,255,255,.2);
    line-height: 1.7;
}
</style>
</head>

<body>

<!-- ══ HEADER ══════════════════════════════════════════════════ -->
<header class="header">
    <span style="font-size:19px;line-height:1">🧩</span>
    <span class="title">Custom Puzzle Block Programming</span>
    <span class="pill pill-blue">Pure CSS  ::before / ::after</span>
    <span class="pill pill-green">HTML5 Drag &amp; Drop API</span>
    <span class="pill pill-amber">Sandbox Eksperimen</span>
    <a class="back" href="{{ route('dashboard.siswa') }}">← Dashboard</a>
</header>

<div class="main">

<!-- ══ TOOLBOX ═════════════════════════════════════════════════ -->
<aside class="toolbox">

    <div class="toolbox-section">
        <h4>Struktur Kelas</h4>

        <!-- CLASS block ·─────────────── keyword + text input -->
        <div class="puzzle-block block-class" draggable="true" data-btype="class">
            <span class="blk-kw">class</span>
            <input class="blk-input" type="text" placeholder="NamaClass">
            <span class="blk-kw">:</span>
        </div>

        <!-- INHERIT block ·──────────── "inherits ClassName" -->
        <div class="puzzle-block block-inherit" draggable="true" data-btype="inherit">
            <span class="blk-kw">inherits</span>
            <input class="blk-input" type="text" placeholder="ParentClass">
        </div>
    </div>

    <div class="toolbox-section">
        <h4>Anggota</h4>

        <!-- ATTR block ·─────────────── self.name = type -->
        <div class="puzzle-block block-attr" draggable="true" data-btype="attr">
            <span class="blk-kw">self.</span>
            <input class="blk-input" type="text" placeholder="atribut">
            <select class="blk-select">
                <option>str</option>
                <option>int</option>
                <option>float</option>
                <option>bool</option>
            </select>
        </div>

        <!-- METHOD block ·───────────── def name(self): -->
        <div class="puzzle-block block-method" draggable="true" data-btype="method">
            <span class="blk-kw">def</span>
            <input class="blk-input" type="text" placeholder="method">
            <span class="blk-kw">(self):</span>
        </div>
    </div>

    <div class="toolbox-section">
        <h4>Akses Modifier</h4>

        <!-- PRIVATE block ·──────────── 🔒 __private_attr -->
        <div class="puzzle-block block-private" draggable="true" data-btype="private">
            <span class="blk-kw">🔒 private</span>
            <input class="blk-input" type="text" placeholder="__atribut">
        </div>

        <!-- PUBLIC block ·───────────── 🌐 public_attr -->
        <div class="puzzle-block block-public" draggable="true" data-btype="public">
            <span class="blk-kw">🌐 public</span>
            <input class="blk-input" type="text" placeholder="atribut">
        </div>
    </div>

    <div class="toolbox-legend">
        Seret blok ke Workspace →<br>
        Susun ulang dengan drag di dalam workspace<br>
        Klik × untuk menghapus blok
    </div>

</aside>

<!-- ══ WORKSPACE ═══════════════════════════════════════════════ -->
<main class="workspace" id="workspace">

    <div class="ws-hint" id="wsHint">
        <span class="ws-hint-arrow">←</span>
        Seret blok puzzle dari Toolbox ke sini<br>
        <span style="font-size:11px;">Drag · Susun · Hapus</span>
    </div>

    <div class="ws-stack" id="wsStack"></div>

</main>
</div><!-- /.main -->


<script>
// ════════════════════════════════════════════════════════════════════
//  Custom Puzzle – HTML5 Drag & Drop
//  Sumber: Toolbox  →  Workspace (copy)
//  Workspace → Workspace (move / reorder)
// ════════════════════════════════════════════════════════════════════

const workspace = document.getElementById('workspace');
const wsStack   = document.getElementById('wsStack');
const wsHint    = document.getElementById('wsHint');

let drag = null;   // { source: 'toolbox'|'workspace', el, wrap }
let uid  = 0;

// ── Prevent inputs / selects from hijacking drag ─────────────────
document.querySelectorAll('.puzzle-block input, .puzzle-block select').forEach(el => {
    el.addEventListener('mousedown', e => e.stopPropagation());
    el.addEventListener('dragstart',  e => e.stopPropagation());
});

// ── TOOLBOX BLOCKS: register drag ────────────────────────────────
document.querySelectorAll('.toolbox .puzzle-block').forEach(block => {
    registerDraggable(block, 'toolbox');
});

function registerDraggable(block, source) {
    block.addEventListener('dragstart', e => {
        drag = { source, el: block, wrap: block.closest('.ws-wrap') };
        // Apply dragging style after the drag-image snapshot
        requestAnimationFrame(() => block.classList.add('is-dragging'));
        e.dataTransfer.effectAllowed = source === 'toolbox' ? 'copy' : 'move';
        e.dataTransfer.setData('text/plain', source); // required for Firefox
    });
    block.addEventListener('dragend', () => {
        block.classList.remove('is-dragging');
        clearIndicators();
        drag = null;
    });
}

// ── WORKSPACE: global dragover / dragleave / drop ─────────────────
workspace.addEventListener('dragover', e => {
    if (!drag) return;
    e.preventDefault();
    workspace.classList.add('drag-over');
    e.dataTransfer.dropEffect = drag.source === 'toolbox' ? 'copy' : 'move';
});
workspace.addEventListener('dragleave', e => {
    if (!workspace.contains(e.relatedTarget)) workspace.classList.remove('drag-over');
});
workspace.addEventListener('drop', e => {
    workspace.classList.remove('drag-over');
    if (!drag || drag.source !== 'toolbox') return; // workspace→workspace handled by block listeners
    e.preventDefault();
    const newWrap = buildWsBlock(drag.el);
    wsStack.appendChild(newWrap);
    refreshHint();
    drag = null;
});

// ── BUILD WORKSPACE BLOCK from toolbox template ───────────────────
function buildWsBlock(src) {
    const wrap = document.createElement('div');
    wrap.className = 'ws-wrap';

    const block = src.cloneNode(true);
    block.id = 'wb' + (++uid);
    block.classList.remove('is-dragging');
    block.draggable = true;

    // Preserve current input values from the toolbox block
    src.querySelectorAll('input, select').forEach((orig, i) => {
        const copy = block.querySelectorAll('input, select')[i];
        if (copy) copy.value = orig.value;
    });

    // Re-register input protection (clone loses event listeners)
    block.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('mousedown', e => e.stopPropagation());
        el.addEventListener('dragstart',  e => e.stopPropagation());
    });

    // Delete (×) button
    const del = document.createElement('button');
    del.className   = 'blk-del';
    del.textContent = '×';
    del.title       = 'Hapus blok';
    del.addEventListener('click', e => {
        e.stopPropagation();
        wrap.remove();
        refreshHint();
    });
    block.appendChild(del);

    registerDraggable(block, 'workspace');
    registerWsDropTarget(wrap, block);

    wrap.appendChild(block);
    return wrap;
}

// ── PER-BLOCK DROP TARGET for reordering ─────────────────────────
function registerWsDropTarget(wrap, block) {
    block.addEventListener('dragover', e => {
        if (!drag || drag.source !== 'workspace') return;
        e.preventDefault();
        e.stopPropagation();
        workspace.classList.remove('drag-over');
        clearIndicators();

        // Show insert-indicator above or below this block
        const indicator = makeIndicator();
        const aboveMe   = e.clientY < wrap.getBoundingClientRect().top + wrap.offsetHeight / 2;
        wsStack.insertBefore(indicator, aboveMe ? wrap : wrap.nextSibling);
    });

    block.addEventListener('drop', e => {
        if (!drag || drag.source !== 'workspace') return;
        e.preventDefault();
        e.stopPropagation();
        workspace.classList.remove('drag-over');
        clearIndicators();

        const { wrap: srcWrap } = drag;
        if (srcWrap && srcWrap !== wrap) {
            const aboveMe = e.clientY < wrap.getBoundingClientRect().top + wrap.offsetHeight / 2;
            wsStack.insertBefore(srcWrap, aboveMe ? wrap : wrap.nextSibling);
        }
        drag = null;
        refreshHint();
    });
}

// ── HELPERS ───────────────────────────────────────────────────────
function makeIndicator() {
    const el = document.createElement('div');
    el.className        = 'drop-indicator';
    el.dataset.indicator = '1';
    return el;
}
function clearIndicators() {
    document.querySelectorAll('[data-indicator]').forEach(el => el.remove());
}
function refreshHint() {
    wsHint.style.display = wsStack.children.length ? 'none' : '';
}
</script>
</body>
</html>
