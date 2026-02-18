@php
    $s = strtolower(trim($status ?? ''));
    $config = match (true) {
        str_contains($s, 'active') || str_contains($s, 'open') => ['class' => 'bg-emerald-50 text-emerald-500', 'dot' => 'bg-emerald-500', 'label' => strtoupper($status)],
        str_contains($s, 'comp') || str_contains($s, 'close') => ['class' => 'bg-red-50 text-red-500', 'dot' => 'bg-red-500', 'label' => strtoupper($status)],
        str_contains($s, 'hold') || str_contains($s, 'pend') => ['class' => 'bg-orange-50 text-orange-500', 'dot' => 'bg-orange-500', 'label' => strtoupper($status)],
        str_contains($s, 'plan') => ['class' => 'bg-blue-50 text-blue-500', 'dot' => 'bg-blue-500', 'label' => strtoupper($status)],
        default => ['class' => 'bg-slate-50 text-slate-500', 'dot' => 'bg-slate-500', 'label' => strtoupper($status)]
    };
@endphp

<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full {{ $config['class'] }} text-[10px] font-black tracking-widest border-none transition-all hover:brightness-95"
    title="Status: {{ $status }}">
    <span class="size-1.5 rounded-full {{ $config['dot'] }} shrink-0"></span>
    {{ str_replace('_', ' ', $config['label']) }}
</div>