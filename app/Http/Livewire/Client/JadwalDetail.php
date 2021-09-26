<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class JadwalDetail extends Component
{

    public function mount($jadwal_id)
    {
        return $this->emit('getJadwalById', $jadwal_id);
    }
    public function render()
    {
        return view('livewire.client.jadwal-detail')->layout('layouts.user');
    }
}
