<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jadwal;
use App\Models\JadwalIbadah as ModelsJadwalIbadah;
use App\Models\Petugas;
use Livewire\Component;


class JadwalIbadah extends Component
{

    public $tbl_jadwal_ibadah_id;
    public $tanggal;
    public $key;
    public $leader_id;
    public $pembaca_kitab_id;
    public $pembaca_doa_id;
    public $penyanyi_id = [];
    public $jadwal_id = [];

    public $pembaca_kitab = [];
    public $pembaca_doa = [];
    public $singers = [];

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataById', 'getId'];

    public function render()
    {
        return view('livewire.admin.tbl-jadwal-ibadah', [
            'items' => ModelsJadwalIbadah::all(),
            'leaders' => Petugas::all(),
            'jadwals' => Jadwal::all(),
        ]);
    }

    public function handleSelect($type = 'leaders', $petugas_id = null)
    {
        $this->emit('loadForm');
        switch ($type) {
            case 'leader':
                $this->leader_id = $petugas_id;
                $this->pembaca_kitab = Petugas::where('id', '!=', $this->leader_id)->get();
                $this->pembaca_doa = [];
                $this->singers = [];
                $this->pembaca_kitab_id = '';

                break;
            case 'pembaca_kitab':
                $this->pembaca_kitab_id = $petugas_id;
                $this->pembaca_doa = Petugas::where('id', '!=', $this->leader_id)->where('id', '!=', $this->pembaca_kitab_id)->get();
                $this->singers = [];
                $this->pembaca_doa_id = '';
                break;
            case 'pembaca_doa':
                $this->pembaca_doa_id = $petugas_id;
                $this->penyanyi_id = [];
                $this->singers = Petugas::where('id', '!=', $this->leader_id)->where('id', '!=', $this->pembaca_kitab_id)->where('id', '!=', $this->pembaca_doa_id)->get();
                break;
        }
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'tanggal'  => $this->tanggal,
            'key'  => $this->key,
            'jadwal_id'  => $this->jadwal_id,
            'leader_id'  => $this->leader_id,
            'pembaca_kitab_id'  => $this->pembaca_kitab_id,
            'pembaca_doa_id'  => $this->pembaca_doa_id
        ];

        $jadwal = ModelsJadwalIbadah::create($data);

        foreach ($this->penyanyi_id as $key => $value) {
            $jadwal->singers()->create(['penyanyi_id' => $value]);
        }

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'tanggal'  => $this->tanggal,
            'key'  => $this->key,
            'leader_id'  => $this->leader_id,
            'jadwal_id'  => $this->jadwal_id,
            'pembaca_kitab_id'  => $this->pembaca_kitab_id,
            'pembaca_doa_id'  => $this->pembaca_doa_id
        ];
        $row = ModelsJadwalIbadah::find($this->tbl_jadwal_ibadah_id);


        $row->update($data);
        $row->singers()->delete();
        foreach ($this->penyanyi_id as $key => $value) {
            $row->singers()->create(['penyanyi_id' => $value]);
        }


        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        $row = ModelsJadwalIbadah::find($this->tbl_jadwal_ibadah_id);
        $row->delete();
        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'tanggal'  => 'required',
            'key'  => 'required',
            'leader_id'  => 'required',
            'pembaca_kitab_id'  => 'required',
            'pembaca_doa_id'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($tbl_jadwal_ibadah_id)
    {
        $tbl_jadwal_ibadah = ModelsJadwalIbadah::find($tbl_jadwal_ibadah_id);
        $this->tbl_jadwal_ibadah_id = $tbl_jadwal_ibadah->id;
        $this->tanggal = $tbl_jadwal_ibadah->tanggal;
        $this->key = $tbl_jadwal_ibadah->key;
        $this->leader_id = $tbl_jadwal_ibadah->leader_id;
        $this->jadwal_id = $tbl_jadwal_ibadah->jadwal_id;
        $this->pembaca_kitab_id = $tbl_jadwal_ibadah->pembaca_kitab_id;
        $this->pembaca_doa_id = $tbl_jadwal_ibadah->pembaca_doa_id;

        $this->pembaca_kitab = Petugas::where('id', '!=', $this->leader_id)->get();
        $this->pembaca_doa = Petugas::where('id', '!=', $this->leader_id)->where('id', '!=', $this->pembaca_kitab_id)->get();
        $this->singers = Petugas::where('id', '!=', $this->leader_id)->where('id', '!=', $this->pembaca_kitab_id)->where('id', '!=', $this->pembaca_doa_id)->get();
        $this->penyanyi_id = $tbl_jadwal_ibadah->singers()->pluck('penyanyi_id')->toArray();
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->showModal();
        }
        $this->update_mode = true;
    }

    public function getId($tbl_jadwal_ibadah_id)
    {
        $tbl_jadwal_ibadah = ModelsJadwalIbadah::find($tbl_jadwal_ibadah_id);
        $this->tbl_jadwal_ibadah_id = $tbl_jadwal_ibadah->id;
    }

    public function toggleForm($form)
    {
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->emit('loadForm');
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->tbl_jadwal_ibadah_id = null;
        $this->tanggal = null;
        $this->key = null;
        $this->leader_id = null;
        $this->jadwal_id = null;
        $this->pembaca_kitab_id = null;
        $this->pembaca_doa_id = null;
        $this->penyanyi_id = [];
        $this->pembaca_kitab = [];
        $this->pembaca_doa = [];
        $this->singers = [];
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
