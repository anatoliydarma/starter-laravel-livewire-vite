<div wire:ignore {{ $attributes->merge(['class' => 'relative w-full border rounded-lg border-slate-300 hover:border-slate-400 z-80']) }}>
    <input id="reserve" type="text" class="dateRange absolute inset-0 w-full h-full opacity-0 cursor-pointer" readonly>
    <div class="flex items-start gap-0 bg-white rounded-lg">
        <div class="border-slate-300 w-6/12 px-3 py-2 space-y-1 border-r">
            <div class="text-xs font-medium text-gray-500 uppercase">
                {{ __('ui.checkin') }}
            </div>
            <div x-show="checkin" x-text="checkin" class="h-6"></div>
            <div x-show="!checkin" x-text="addDate" class="h-6"></div>
        </div>
        <div class="w-6/12 px-3 py-2 space-y-1">
            <div class="text-xs font-medium text-gray-500 uppercase">
                {{ __('ui.checkout') }}
            </div>
            <div x-show="checkout" x-text="checkout"></div>
            <div x-show="!checkout" x-text="addDate" class="h-6"></div>
        </div>
    </div>
</div>
