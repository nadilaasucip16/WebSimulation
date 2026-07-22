{{--
  _dashboard-phase-card.blade.php
  Vars: $phase (num, title, desc, route), $done, $isActive, $isLocked, $accent
--}}
@php
$palettes = [
    'green'  => ['btn'=>'bg-green-600 hover:bg-green-700',  'ulangi'=>'text-green-600 hover:text-green-800'],
    'blue'   => ['btn'=>'bg-blue-600 hover:bg-blue-700',    'ulangi'=>'text-blue-600 hover:text-blue-800'],
    'purple' => ['btn'=>'bg-purple-600 hover:bg-purple-700','ulangi'=>'text-purple-600 hover:text-purple-800'],
];
$c = $palettes[$accent] ?? $palettes['green'];
@endphp

<div class="bg-white rounded-xl border p-4 flex flex-col gap-3
            {{ $isLocked ? 'border-gray-100 opacity-50' : 'border-gray-200' }}">

    <div class="flex items-center gap-1.5">
        <span class="text-[10px] font-semibold uppercase tracking-wide {{ $done ? 'text-green-600' : ($isActive ? 'text-gray-700' : 'text-gray-400') }}">
            Fase {{ $phase['num'] }}
        </span>
        @if($done)
        <span class="text-[10px] text-green-500">· Selesai</span>
        @endif
    </div>

    <div class="flex-1 min-w-0">
        <p class="text-sm font-semibold text-gray-800 leading-tight">{{ $phase['title'] }}</p>
        <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $phase['desc'] }}</p>
    </div>

    @if($done)
        <a href="{{ route($phase['route']) }}" class="text-xs font-medium {{ $c['ulangi'] }} transition">
            Ulangi →
        </a>
    @elseif($isActive)
        <a href="{{ route($phase['route']) }}"
           class="inline-flex items-center justify-center text-sm font-semibold px-4 py-2 rounded-lg
                  {{ $c['btn'] }} text-white transition">
            Mulai
        </a>
    @else
        <span class="text-xs text-gray-400">Terkunci</span>
    @endif

</div>
