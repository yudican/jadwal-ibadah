<?php

namespace App\Http\Livewire\Client;

use App\Models\Jadwal;
use App\Models\JadwalIbadah;
use Livewire\Component;

class HomeUser extends Component
{
    public function render()
    {
        return view('livewire.client.home-user', [
            'jadwals' => Jadwal::all()
        ])->layout('layouts.user');
    }
}
