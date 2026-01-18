@php
    $s = strtolower(trim($status ?? ''));
    $config = match (true) {
        str_contains($s, 'active') || str_contains($s, 'open')   => ['class' => 'bg-success/10 text-success border-success/20', 'dot' => 'bg-success'],
        str_contains($s, 'comp')   || str_contains($s, 'close')  => ['class' => 'bg-error/10 text-error border-error/20',     'dot' => 'bg-error'],
        str_contains($s, 'hold')   || str_contains($s, 'pend')   => ['class' => 'bg-warning/10 text-warning border-warning/20', 'dot' => 'bg-warning'],
        str_contains($s, 'plan')                                 => ['class' => 'bg-primary/10 text-primary border-primary/20', 'dot' => 'bg-primary'],
        default                                                  => ['class' => 'bg-base-200 text-base-content/50 border-base-content/10', 'dot' => 'bg-base-content/30']
    };
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $config['class'] }} border transition-all hover:brightness-95" title="Status: {{ $status }}">
    <span class="size-1.5 rounded-full {{ $config['dot'] }} shrink-0"></span>
    {{ str_replace('_', ' ', $status) }}
</span>