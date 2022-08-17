@props(['placeholder' => 'Search'])
<div class="relative w-full max-w-lg">
    <input type="search" class="w-full py-3 pl-10 pr-4 text-base placeholder-gray-400 form-input bg-slate-50 border-1 rounded-xl hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0" wire:model.debounce.600ms="search" placeholder="{{ $placeholder }}" autocomplete="off" inputmode="search">
    <div class="absolute inline-flex items-center p-2 top-1 left-1">
        <x-tabler-search class="w-6 h-6 text-gray-400" />
    </div>
</div>
