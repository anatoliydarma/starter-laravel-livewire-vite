<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ErrorCatcher extends Component
{
    protected $listeners = ['getError'];

    public function getError($msg, $source, $lineNo, $columnNo, $error, $url)
    {
        Log::channel('slack')->error('javascript: ' . $msg . PHP_EOL . 'source: ' . $source . PHP_EOL . 'lineNo: ' . $lineNo . PHP_EOL . 'columnNo: ' . $columnNo . PHP_EOL . 'error: ' . json_encode($error) . 'URL: ' . $url);
    }

    public function render()
    {
        return view('livewire.error-catcher');
    }
}
