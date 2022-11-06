<div x-data="searchInput" @set-users.window="setSourceData(event)" class="relative">
    <div class="flex items-center justify-between w-full">
        <div :class="showInput ? 'w-44 visible' : 'w-0 invisible'" class="-top-2 -left-44 absolute block -ml-2 transition duration-500">
            <div class="left-2 text-slate-200 absolute inset-y-0 flex items-center justify-start">
                <x-tabler-search class="w-6 h-6" />
            </div>
            <input type="text" x-trap="showInput" @input="getItems" placeholder="Type user name" x-model="search" class="border-slate-200 bg-slate-50 form-input placeholder:text-slate-300 focus:ring-0 focus:outline-none block w-full py-2 pl-10 border rounded-lg outline-none">

            <div x-show="isOpen" role="listbox" @click.outside="closeSearch" class="w-44 top-10 divide-slate-100 absolute left-0 z-30 h-auto overflow-x-hidden overflow-y-auto bg-white divide-y rounded-lg shadow-lg" style="max-height: 200px">
                <template x-for="item in getItems" :key="item.id">
                    <button x-text="item.name ? item.name : item.email" @click="cleanSearch(item.id)" wire:click="newChat(item.id)" class="hover:bg-slate-50 w-full px-3 py-2 text-left cursor-pointer"></button>
                </template>
            </div>
        </div>
        <div>
            <button x-show="!showInput" wire:click="getUsers" class="text-slate-500 hover -mr-1">
                <x-tabler-message-plus wire:loading.remove class=" w-6 h-6" />
                <span x-clock wire:loading.flex>
                    <x-tabler-loader class="animate-spin w-6 h-6" />
                </span>
            </button>
            <button x-show="showInput" @click="showInput = false" class="text-slate-500 hover -mr-1">
                <x-tabler-x wire:loading.remove class="w-6 h-6" />
                <span x-clock wire:loading.flex>
                    <x-tabler-loader class="animate-spin w-6 h-6" />
                </span>
            </button>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchInput', () => ({
                showInput: false
                , isOpen: false
                , search: ""
                , loading: false
                , sourceData: []
                , get getItems() {

                    const filterItems = this.sourceData.filter((item) => {
                        return item.name.toLowerCase().startsWith(this.search.toLowerCase())
                    })
                    if (filterItems.length < this.sourceData.length && filterItems.length > 0) {
                        this.isOpen = true
                        return filterItems
                    } else {
                        this.isOpen = false
                    }
                }
                , cleanSearch(id) {
                    this.loading = true;
                    this.isOpen = false
                    window.livewire.emit('createChat', id)
                    this.search = ""
                    this.showInput = false
                }
                , closeSearch() {
                    this.search = ""
                    this.isOpen = false
                }
                , setSourceData(event) {
                    this.loading = false;
                    this.showInput = true
                    this.sourceData = event.detail.users
                }

            }))
        })
    </script>
</div>
