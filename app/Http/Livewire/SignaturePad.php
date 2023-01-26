<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SignaturePad extends Component
{
    public $signature;

    public function submit()
    {
        Storage::put('signatures/signature.png', base64_decode(Str::of($this->signature)->after(',')));
    }

    public function render()
    {
        return view('livewire.signature-pad');
    }
}
