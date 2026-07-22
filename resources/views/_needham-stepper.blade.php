{{-- Needham Five Phase Model Stepper --}}
{{-- @include('_needham-stepper', ['currentFase' => N]) --}}
@php
$_steps = [1 => 'Orientasi', 2 => 'Pencetusan Ide', 3 => 'Penstrukturan', 4 => 'Aplikasi', 5 => 'Refleksi'];
$_ac    = '#16a34a';
$_tc    = '#15803d';
@endphp
<div class="flex items-center mb-8 overflow-x-auto pb-1">
    @foreach($_steps as $n => $nama)
    <div class="flex items-center">
        <div class="flex flex-col items-center gap-1 px-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold border-2 transition-all"
                 style="{{ $n <= $currentFase
                     ? "background:{$_ac};border-color:{$_ac};color:white;"
                     : 'background:white;border-color:#e5e7eb;color:#9ca3af;' }}">
                {{ $n < $currentFase ? '✓' : $n }}
            </div>
            <span class="text-xs font-medium whitespace-nowrap"
                  style="{{ $n === $currentFase ? "color:{$_tc};font-weight:700;" : 'color:#9ca3af;' }}">
                {{ $nama }}
            </span>
        </div>
        @if($n < 5)
        <div class="h-0.5 w-8 flex-shrink-0"
             style="{{ $n < $currentFase ? "background:{$_ac};" : 'background:#e5e7eb;' }}"></div>
        @endif
    </div>
    @endforeach
</div>
