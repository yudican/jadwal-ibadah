<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PanduanUmum extends Component
{
    public function render()
    {
        return view('livewire.panduan-umum')->layout('layouts.user');
    }
}
