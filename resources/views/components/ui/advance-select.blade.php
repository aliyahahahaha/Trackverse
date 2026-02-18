@props([
    'name',
    'options' => [],
    'selected' => [],
    'placeholder' => 'Select collaborator...',
    'label' => null,
    'id' => null,
    'multiple' => true
])

@php
    $id = $id ?? 'select-' . Str::random(8);
    $selectedArray = is_array($selected) ? $selected : [$selected];

    $config = [
        'placeholder' => $placeholder,
        'toggleTag' => '<button type="button" aria-expanded="false"></button>',
        'dropdownClasses' => 'advance-select-menu max-h-60 mt-2 p-2 bg-base-100 border border-base-content/10 shadow-2xl rounded-[1.5rem] overflow-y-auto z-[9999]',
        'optionClasses' => 'advance-select-option hover:bg-primary/10 py-3 px-4 rounded-2xl cursor-pointer transition-all active:scale-[0.98] selected:select-active mb-1',
        'optionTemplate' => '<div class="flex items-center gap-3.5"> <div class="w-10 h-10 rounded-xl shadow-sm border border-base-content/5 overflow-hidden shrink-0 flex items-center justify-center bg-base-200/50" data-icon></div> <div class="flex flex-col overflow-hidden gap-0.5"> <span class="text-[13px] font-black text-base-content uppercase tracking-tight leading-tight" data-title></span> <span class="text-[10px] text-base-content/30 font-bold uppercase tracking-widest leading-none" data-description></span> </div> </div>',
        'extraMarkup' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" class="text-base-content/20 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none group-focus-within:rotate-180 transition-transform flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6l6 -6" /></svg>'
    ];

    if ($multiple) {
        $config['mode'] = 'tags';
        $config['wrapperClasses'] = 'advance-select-tag relative flex flex-wrap items-center gap-2 px-4 py-2 min-h-[48px] bg-base-100 border border-base-content/10 hover:border-primary/30 focus-within:border-primary focus-within:ring-4 focus-within:ring-primary/5 transition-all rounded-xl w-full text-start text-sm font-medium leading-none text-base-content outline-none';
        $config['tagsItemTemplate'] = '<div class="flex items-center bg-primary/5 border border-primary/10 rounded-lg pl-1.5 pr-0.5 py-1 transition-all"> <div class="w-5 h-5 mr-1.5 rounded-md overflow-hidden shrink-0 shadow-sm" data-icon></div> <div class="text-[10px] font-bold text-primary pr-1 uppercase tracking-tighter truncate max-w-[140px]" data-title></div> <div class="btn btn-ghost btn-circle btn-xs hover:bg-primary/20 hover:text-primary ml-0.5 focus:outline-none h-5 w-5 min-h-0" data-remove><svg xmlns="http://www.w3.org/2000/svg" style="width: 12px; height: 12px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></div> </div>';
        $config['tagsInputClasses'] = 'bg-transparent border-none focus:ring-0 text-sm font-medium text-base-content placeholder:text-base-content/20 placeholder:font-black flex-grow py-1 px-1';
    } else {
        $config['mode'] = 'default';
        $config['toggleClasses'] = 'advance-select-toggle relative h-12 flex items-center pl-4 pr-11 py-2 border border-base-content/10 bg-base-100 hover:border-primary border-2 focus-within:border-primary focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all rounded-xl w-full text-start text-[14px] font-black text-base-content outline-none';
        $config['toggleTemplate'] = '<div class="flex items-center gap-3"> <div class="w-8 h-8 rounded-lg overflow-hidden shrink-0 border border-base-content/5 shadow-sm" data-icon></div> <div class="truncate font-black text-[14px] leading-none" data-title></div> </div>';
    }
@endphp

<div class="w-full group">
    @if($label)
        <label class="label px-1 pt-0 pb-2">
            <span class="text-[10px] font-bold uppercase tracking-widest text-base-content/30">
                {{ $label }}
            </span>
        </label>
    @endif
    
    <div class="relative">
        <select
            {{ $attributes }}
            id="{{ $id }}"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            {{ $multiple ? 'multiple' : '' }}
            data-select='@json($config)'
            class="hidden"
        >
            <option value="">{{ $multiple ? 'Choose' : $placeholder }}</option>
            @foreach($options as $option)
                <option
                    value="{{ $option['value'] }}"
                    @selected(in_array($option['value'], $selectedArray))
                    data-select-option='@json([
                        "description" => $option['description'] ?? '',
                        "icon" => ($option['image'] ?? null) 
                            ? '<img class="w-full h-full object-cover" src="' . $option['image'] . '" />' 
                            : ($option['icon'] ?? '<svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" class="text-base-content/20 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" /></svg>')
                    ])'
                >
                    {{ $option['label'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<style>
    /* Luxury Hover & Selection States */
    .advance-select-option.selected {
        background-color: oklch(var(--p) / 0.15) !important;
        border-right: 3px solid oklch(var(--p));
    }
    .advance-select-option:hover {
        background-color: oklch(var(--p) / 0.08) !important;
        transform: translateX(4px);
    }
    /* Standardize Placeholder Look */
    .advance-select-toggle {
        display: flex !important;
        align-items: center !important;
    }
    .advance-select-toggle[aria-expanded="false"] {
        color: oklch(var(--bc) / 0.2) !important;
        font-weight: 500 !important;
    }
    /* Hide scrollbar for select menu */
    .advance-select-menu::-webkit-scrollbar {
        width: 4px;
    }
    .advance-select-menu::-webkit-scrollbar-track {
        background: transparent;
    }
    .advance-select-menu::-webkit-scrollbar-thumb {
        background: oklch(var(--bc) / 0.1);
        border-radius: 10px;
    }
    /* Tag Micro-animations */
    .advance-select-tag > div {
        animation: tagAppear 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes tagAppear {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
