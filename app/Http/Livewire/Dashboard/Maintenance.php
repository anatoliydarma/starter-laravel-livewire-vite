<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Maintenance extends Component
{
    use WireToast;

    public function removePhpCache()
    {
        try {
            Cache::flush();

            return toast()
                ->success('Cache PHP cleaned')
                ->push();
        } catch (\Throwable $th) {
            Log::error($th);

            return toast()
                ->warning('Cache PHP was not cleaned')
                ->push();
        }
    }

    public function removeAllCache()
    {
        try {
            \Artisan::call('optimize:clear');
            \Artisan::call('optimize');
            toast()
                ->success('Cache HTML cleaned')
                ->push();
        } catch (\Throwable$th) {
            toast()
                ->warning('Cache HTML was not cleaned')
                ->push();

            \Log::error($th);
        }
    }

    public function backupDb()
    {
        try {
            \Artisan::call('backup:run --only-db');

            toast()
            ->success('Backup is done')
            ->push();
        } catch (\Throwable $th) {
            toast()
            ->warning('Backup is not done')
            ->push();

            \Log::error($th);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.maintenance')
            ->layout('components.layouts.dashboard.app');
    }
}
