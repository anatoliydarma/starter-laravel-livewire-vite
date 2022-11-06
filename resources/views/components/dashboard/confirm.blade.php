@props(['confirmId' => null])
<div x-cloak x-data="{ confirmId: null }" x-effect="document.body.classList.toggle('overflow-hidden', confirmId), document.body.classList.toggle('h-screen', confirmId)">

    <div x-show="confirmId === {{ $confirmId }}" x-transition.opacity class="fixed top-0 left-0 flex items-center justify-center w-full h-screen min-w-full bg-slate-500 bg-opacity-50 z-60" role="dialog" aria-modal="true">

        <div @click.outside="confirmId = null" @keydown.esc="confirmId = null" class="absolute flex flex-col w-full max-w-xs shadow-2xl z-70 bg-slate-50 rounded-xl">

            <button class="absolute top-0 right-0 p-1 text-slate-500 transition-all duration-300 rounded-full hover:text-slate-600 hover:bg-slate-100 focus:outline-none focus:shadow-outline" x-on:click="confirmId = null">
                <x-tabler-x class="w-6 h-6 stroke-current" />
            </button>

            <div class="flex items-center justify-center px-5 py-4">
                <h2 class="text-xl leading-tight text-slate-700">
                    Confirm deletion.
                </h2>
            </div>

            <div class="flex items-center justify-center px-5 py-4 space-x-8">
                <button x-on:click="confirmId = null" class="px-5 py-2 font-semibold text-slate-600 transition duration-150 bg-white border border-slate-300 rounded-lg hover:bg-slate-300 hover:border-slate-300 hover:text-slate-900 focus:outline-none focus:shadow-outline">Cancel</button>

                <button {{ $attributes->whereStartsWith('wire:click') }} x-on:click="confirmId = null" class="px-5 py-2 font-semibold text-white transition duration-150 bg-red-500 rounded-lg hover:bg-red-600 focus:outline-none focus:shadow-outline">Delete</button>
            </div>

        </div>
    </div>

    <button @click="confirmId = {{ $confirmId }}" class="p-2 hover">
        {{ $slot }}
    </button>

</div>
