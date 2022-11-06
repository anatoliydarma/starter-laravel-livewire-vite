@props(['width' => 'max-w-lg', 'form' => ''])
<div>
    <div x-cloak @click="closeForm" wire:click="closeForm" x-show="form{{ $form }}" x-transition.opacity class=" fixed top-0 bottom-0 left-0 right-0 z-40 w-screen h-screen overflow-hidden bg-gray-600 bg-opacity-25 cursor-pointer pointer-events-auto">
    </div>

    <div id="modal" @keyup.escape.window="form{{ $form }} = false" :class="form{{ $form }} ? 'translate-x-0' : 'translate-x-full'" class="{{ $width }} fixed top-0 right-0 z-50 w-full h-screen transition-all duration-500 ease-in-out transform bg-white text-gray-700">
        <div class="top-4 right-4 absolute">
            <button x-on:click="closeForm" wire:click="closeForm" class="hover">
                <x-tabler-circle-x class="w-6 h-6 stroke-current" />
            </button>
        </div>
        {{ $slot }}
    </div>
</div>
