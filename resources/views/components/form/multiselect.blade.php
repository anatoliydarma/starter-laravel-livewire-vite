<div x-cloak x-data="multiselect">

    <div class="flex flex-col items-center w-full h-64 mx-auto md:w-1/2">
        <div class="relative inline-block w-64">
            <div class="relative flex flex-col items-center">
                <div x-on:click="open" class="w-full">
                    <div class="flex p-1 my-2 border border-gray-200 rounded bg-slate-50">
                        <div class="flex flex-wrap flex-auto">
                            <template x-for="(option, index) in selected" :key="index">
                                <div class="flex items-center justify-center px-1 py-1 m-1 font-medium border rounded bg-slate-50">
                                    <div class="flex-initial max-w-full text-xs font-normal leading-none" x-model="option" x-text="options[option]"></div>
                                    <div class="flex flex-row-reverse flex-auto">
                                        <div x-on:click.stop="remove(index, option)">
                                            <x-tabler-x class="stroke-1.5 w-4 h-4" />
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="selected.length == 0" class="flex-1">
                                <input placeholder="Select a option" class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none" x-bind:value="selectedValues()">
                            </div>
                        </div>
                        <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 border-l border-gray-200 svelte-1l8159u">

                            <button type="button" x-show="isOpen() === true" x-on:click="open" class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                <x-tabler-chevron-down class="stroke-1.5 w-5 h-5" />
                            </button>
                            <button type="button" x-show="isOpen() === false" @click="close" class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                <x-tabler-chevron-up class="stroke-1.5 w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4">
                    <div x-show.transition.origin.top="isOpen()" class="absolute left-0 z-40 w-full bg-white rounded shadow top-100 max-h-select" x-on:click.away="close">
                        <div class="flex flex-col w-full h-64 overflow-y-auto">
                            <template x-for="(option, index) in options" :key="option" class="overflow-auto">
                                <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-gray-100" @click="select(index, $event)">
                                    <div class="relative flex items-center w-full p-2 border-l-2 border-transparent">
                                        <div class="flex items-center justify-between w-full">
                                            <div class="mx-2 leading-6" x-model="option" x-text="option"></div>
                                            <div x-show="option === selected[option]">
                                                <x-tabler-check class="stroke-1.5 w-5 h-5" />
                                            </div>
                                            <div x-text="options[option]"> </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('multiselect', () => ({
                options: @js($options)
                , selected: []
                , show: false
                , open() {
                    this.show = true
                }
                , close() {
                    this.show = false
                }
                , isOpen() {
                    return this.show === true
                }
                , select(index, event) {
                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                }
                , remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);
                }
                , selectedValues() {
                    return this.selected.map((option) => {
                        return this.options[option].value;
                    })
                }

            , }))
        })
    </script>
</div>
