@props(['width' => 'max-w-lg'])
<div id="modal" @keyup.escape.window="form = false" :class="form ? 'translate-x-0' : 'translate-x-full'" class="{{ $width }} fixed top-0 right-0 z-40 w-full h-screen transition-all duration-500 ease-in-out transform bg-slate-100 text-slate-700 overflow-y-auto">
    <div class="absolute top-4 right-4">
        <button x-on:click="closeForm" wire:click="closeForm" class="hover">
            <x-tabler-circle-x class="w-6 h-6 stroke-current" />
        </button>
    </div>

    {{ $slot }}

</div>
