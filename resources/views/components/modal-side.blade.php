<div x-cloak x-data="{ open: false }" class="relative" x-effect="document.body.classList.toggle('overflow-hidden', open)" x-on:open-modal.window="open = true" x-on:close-modal-side.window="open = false">

    <div @click="open = true" aria-label="Open a modal window">
        {{ $button }}
    </div>

    <div @click="open = false" x-show="open" x-transition.opacity class="bg-slate-700 backdrop-filter backdrop-blur-sm transform-gpu fixed top-0 bottom-0 left-0 right-0 z-50 w-screen h-screen overflow-hidden transition-all bg-opacity-50 cursor-pointer pointer-events-auto">
    </div>

    <div :class="open ? 'translate-x-0' : 'translate-x-full'" {{ $attributes->merge(['class' =>'fixed top-0 right-0 z-60 w-full h-screen max-w-md min-w-full px-8 py-6 transition-all duration-500 ease-in-out transform bg-slate-300 lg:min-w-half text-slate-600']) }}>
        <div>
            <div x-show="open" x-transition.duration.1000 class="z-60 top-4 right-6 fixed">
                <button @click="open = false" class="text-slate-600 link-hover">
                    <x-tabler-circle-x class="w-6 h-6 stroke-current" />
                </button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
