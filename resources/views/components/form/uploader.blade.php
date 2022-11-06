<div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
    <div class="relative w-32 h-32 border-2 border-dashed rounded-lg border-slate-200 bg-slate-50 hover:border-slate-400">
        <input type="file" {{ $attributes->whereStartsWith('wire:model') }} multiple class="absolute z-20 block w-full h-full outline-none opacity-0 cursor-pointer">

        <div x-show="isUploading" x-transition.opacity class="absolute top-0 left-0 right-0 z-30 flex items-center justify-start h-full ">
            <span class="relative flex items-center w-64 h-2 mx-auto overflow-hidden bg-slate-300 rounded-2xl">
                <span class="absolute left-0 w-full h-full transition-all duration-300 bg-green-500" :style="`width: ${ progress }%`"></span>
            </span>
        </div>
        <div class="flex flex-col items-center justify-center w-full h-full space-y-2 text-gray-500">
            <div class="flex px-4 text-xs text-center">{{ $slot }}</div>
        </div>
    </div>
</div>
