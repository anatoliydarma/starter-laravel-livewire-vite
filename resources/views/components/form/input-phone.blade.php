<div x-data="searchPhone">
    <div class="relative">
        <div class="relative flex items-center max-w-full">
            <button type="button" @click="openDropbox()" class="border-slate-200 rounded-l-md form-input focus:outline-none focus:ring-0 bg-slate-50 hover:border-slate-300 focus:bg-white w-28 relative flex items-center justify-between gap-1 px-3 py-2 text-base">
                <span x-show="selected.length == 0">
                    <x-tabler-plus class="text-slate-400 w-6 h-6" />
                </span>
                <span x-show="selected.length != 0" x-text="selected.flag"></span>
                <span x-show="selected.length != 0" x-text="`+${selected.calling_code}`"></span>
                <div class="flex items-center justify-end">
                    <x-tabler-chevron-down class="text-slate-400 w-4 h-4" />
                </div>
            </button>
            <input id="phoneField" :disabled="disabled" type="text" x-mask="999 999 9999" :placeholder="[!selected.name ? '{{ __('ui.select-country-code') }}' : 'XXX XXX XXXX']" inputmode="numeric" class="rounded-r-md form-input bg-slate-50 border-1 hover:border-slate-300 border-slate-200 focus:outline-none focus:bg-white focus:ring-0 placeholder:text-slate-400 disabled:cursor-not-allowed w-full text-base" {{ $attributes->whereStartsWith('wire:model') }}>
        </div>
        <div x-cloak x-show="open" @click.outside="open = false" class="border-slate-100 w-60 top-12 absolute z-10 overflow-hidden bg-white border rounded-md shadow-lg">
            <div class="relative flex items-center gap-2 p-2">
                <x-tabler-search class="text-slate-400 left-4 top-4 absolute w-5 h-5" />
                <input id="searchField" type="text" @input="getItems" placeholder="{{ __('ui.search') }}" x-model="search" class="form-input focus:ring-0 hover:bg-gray-50 px-9 w-full py-2 text-sm bg-white border-transparent rounded-md" />
                <x-tabler-x x-show="search" @click="cleanSearch" class="text-slate-500 right-4 top-4 absolute w-5 h-5 cursor-pointer" />
            </div>
            <div class="h-60 sm:text-sm scrollbar w-full max-w-xs overflow-x-hidden overflow-y-auto text-base bg-white">
                <template x-for="item in getItems" :key="item.id">
                    <button type="button" @click="selected = item, closeSearch()" class="pr-9 hover:bg-blue-50 relative py-1 pl-3 text-gray-900 cursor-pointer select-none">
                        <div class="flex items-center gap-1">
                            <span class="mr-2 text-lg" x-text="item.flag"></span>
                            <span class="truncate" x-text="item.name"></span>
                            <span class="text-gray-500" x-text="`(+${item.calling_code})`"></span>
                        </div>
                        <span x-show="selected.calling_code == item.calling_code" class="absolute inset-y-0 right-0 flex items-center px-2 text-indigo-600">
                            <x-tabler-check class="w-5 h-5 text-blue-500" />
                        </span>
                    </button>
                </template>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchPhone', () => ({
                open: false
                , disabled: true
                , search: ''
                , selected: @entangle('selectedCountry').defer
                , init() {
                    this.selected = @js($country)
                }
                , get getItems() {
                    const filterItems = this.sourceData.filter((item) => {
                        return item.name.toLowerCase().startsWith(this.search.toLowerCase())
                    })
                    return filterItems
                }
                , openDropbox() {
                    this.open = !this.open;
                    document.getElementById("searchField").focus();
                    this.disabled = false;
                }
                , cleanSearch() {
                    this.search = ""
                }
                , closeSearch() {
                    this.search = "";
                    document.getElementById("phoneField").focus();
                    this.open = false;
                }
                , sourceData: @js($countries)

            , }))
        })
    </script>
</div>
