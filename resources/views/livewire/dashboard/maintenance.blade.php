@section('title')
Maintenance
@endsection
<div>

    <div class="flex items-center justify-start pb-6 space-x-4">
        <div>
            <a title="back" href="javascript:%20history.go(-1)" class="text-slate-300 hover:text-slate-500">
                <x-tabler-arrow-left class="w-6 h-6" />
            </a>
        </div>
        <h3 class="text-xl font-bold text-slate-500">Maintenance</h3>
    </div>


    <div class="flex flex-col justify-start gap-6 p-4 bg-white md:items-center rounded-2xl md:flex-row">

        <x-button wire:click='removePhpCache'>
            Clear PHP cache
        </x-button>

        <x-button wire:click='removeAllCache'>
            Clear HTML cache
        </x-button>

        <x-button wire:click='backupDb'>
            Make a database backup
        </x-button>

    </div>



</div>
