<?php

namespace App\Http\Livewire;

use App\Models\Jadwal;
use App\Models\Petugas;
use App\Models\TempatIbadah;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'petugas' => Petugas::count(),
            'tempat' => TempatIbadah::count(),
            'jadwal' => Jadwal::count(),
        ]);
    }
}
