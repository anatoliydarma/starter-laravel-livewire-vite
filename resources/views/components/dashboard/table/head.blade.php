@props ([
'sortable' => null,
'direction' => null,
])

<th {{ $attributes->merge(['class' => 'px-6 py-3 bg-slate-200/50 text-left'])->only('class') }}>
    @unless($sortable)
    <span class="text-xs font-medium leading-4 tracking-wider text-left uppercase text-slate-700">
        {{ $slot }}
    </span>
    @else
    <button {{ $attributes->except('class') }} class="flex items-center space-x-1 text-xs font-medium leading-4 tracking-wider text-left uppercase text-slate-700 group">
        <span>{{ $slot }}</span>
        @if ($direction === 'asc')
        <x-tabler-chevron-down class="w-4 h-4 stroke-current" />
        @elseif ($direction === 'desc')
        <x-tabler-chevron-up class="w-4 h-4 stroke-current" />
        @else
        <div class="transition-opacity duration-300 opacity-0 group-hover:opacity-100">
            <x-tabler-chevron-down class="w-4 h-4 stroke-current" />
        </div>
        @endif

    </button>
    @endif
</th>
