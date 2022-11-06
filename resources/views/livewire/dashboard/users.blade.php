@section('title')
Users
@endsection
<div>
    <div x-data="handler" @get-items.window="getItems(event)" @new.window="openForm(event)" @save.window="saveForm(event)" @close.window="closeForm(event)" class="space-y-2">

        <div class="flex items-center justify-between w-full pb-2 space-x-6">
            <h3 class="text-2xl">Users</h3>
        </div>

        <div class="flex items-center justify-between w-full space-x-6">
            <x-dashboard.search />

            <x-button @click="openForm">
                Add new
            </x-button>

        </div>

        <div class="py-4">
            <x-dashboard.table>
                <x-slot name="head">
                    <x-dashboard.table.head sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">
                        Id
                    </x-dashboard.table.head>
                    <x-dashboard.table.head sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">
                        Name
                    </x-dashboard.table.head>
                    <x-dashboard.table.head sortable wire:click="sortBy('email')" :direction="$sortField === 'email' ? $sortDirection : null">
                        Email
                    </x-dashboard.table.head>
                    <x-dashboard.table.head></x-dashboard.table.head>
                </x-slot>
                <x-slot name="body">
                    @forelse($users as $key => $user)
                    <x-dashboard.table.row>

                        <x-dashboard.table.cell>
                            {{ $user->id }}
                        </x-dashboard.table.cell>

                        <x-dashboard.table.cell>
                            {{ $user->name }}
                        </x-dashboard.table.cell>

                        <x-dashboard.table.cell>
                            <div class="flex items-center gap-2">
                                {{ $user->email }}
                                @if ($user->email_verified_at !== null)
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                @else
                                <div class="w-3 h-3 rounded-full bg-slate-400"></div>

                                @endif
                            </div>
                        </x-dashboard.table.cell>

                        <x-dashboard.table.cell>
                            <div class="flex items-center justify-end lg:invisible group-hover:visible text-slate-700">
                                <button @click="openForm" wire:click="openForm({{ $user->id }})" title="Edit" class="p-2 hover">
                                    <x-tabler-edit class="stroke-1.5 w-7 h-7" />
                                </button>

                                <x-dashboard.confirm :confirmId="$user->id" wire:click="remove({{ $user->id }})">
                                    <x-tabler-trash class="stroke-1.5 w-7 h-7" />
                                </x-dashboard.confirm>
                            </div>
                        </x-dashboard.table.cell>

                    </x-dashboard.table.row>
                    @empty
                    <x-dashboard.table.row>
                        <x-dashboard.table.cell colspan="4">
                            Empty
                        </x-dashboard.table.cell>
                    </x-dashboard.table.row>
                    @endforelse
                </x-slot>
            </x-dashboard.table>
        </div>

        <div>
            <x-overflow-bg />

            <x-dashboard.modal-side>
                <div class="px-8 py-12 overflow-y-auto md:px-12">

                    <x-loader wire:target="openForm, remove" />

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <x-form.label for="name" :value="__('Name')" />
                            <x-form.input wire:model.defer="name" id="name" type="text" name="name" required autofocus class="w-full max-w-xs" />
                            <x-form.input-error for="name" />
                        </div>

                        <div class="space-y-1">
                            <x-form.label for="email" :value="__('Email')" />
                            <x-form.input wire:model.defer="email" id="email" type="email" name="email" required class="w-full max-w-xs" />
                            <x-form.input-error for="email" />
                        </div>

                        <div class="space-y-1">
                            <x-form.label for="password" :value="__('Password')" />
                            <x-form.input wire:model.defer="password" id="password" type="text" name="password" class="w-full max-w-xs" />
                            <x-form.input-error for="password" />
                        </div>

                        <x-button wire:click="save">
                            Create
                        </x-button>
                    </div>
                </div>
            </x-dashboard.modal-side>
        </div>

        <div class="flex flex-col items-center gap-4 lg:flex-row">
            <div class="w-full md:w-8/12">
                {{ $users->links() }}
            </div>

            <div class="flex items-center justify-end w-full space-x-4 md:w-4/12">
                <x-dashboard.items-per-page />
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('handler', () => ({
                    form: false
                    , confirm: null
                    , body: document.body
                    , openForm() {
                        this.form = true
                        this.body.classList.add("overflow-hidden")
                    },

                    closeForm() {
                        this.form = false
                        this.body.classList.remove("overflow-hidden")
                    },

                    askDelete($id) {
                        this.confirm = $id
                    }
                    , closeConfirm() {
                        this.confirm = null
                    }
                , }))
            })
        </script>

        <script>
            document.addEventListener("keydown", function(e) {
                if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey) && e.keyCode == 83) {
                    e.preventDefault();
                    window.livewire.emit('save')
                }
            }, false);
        </script>

    </div>
</div>
