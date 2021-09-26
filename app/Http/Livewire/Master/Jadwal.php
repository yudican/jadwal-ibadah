<?php

namespace App\Http\Livewire\Master;

use App\Models\Jadwal as ModelsJadwal;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Jadwal extends Component
{
    use WithFileUploads;
    public $tbl_jadwal_id;
    public $jadwal_nama;
    public $jadwal_logo;
    public $jadwal_logo_path;


    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataById', 'getId'];

    public function render()
    {
        return view('livewire.master.tbl-jadwal', [
            'items' => ModelsJadwal::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        $jadwal_logo = $this->jadwal_logo_path->store('upload', 'public');
        $data = [
            'jadwal_nama'  => $this->jadwal_nama,
            'jadwal_logo'  => $jadwal_logo,
        ];

        ModelsJadwal::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'jadwal_nama'  => $this->jadwal_nama,
        ];
        $row = ModelsJadwal::find($this->tbl_jadwal_id);


        if ($this->jadwal_logo_path) {
            $jadwal_logo = $this->jadwal_logo_path->store('upload', 'public');
            $data = ['jadwal_logo' => $jadwal_logo];
            if (Storage::exists('public/' . $this->jadwal_logo)) {
                Storage::delete('public/' . $this->jadwal_logo);
            }
        }

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsJadwal::find($this->tbl_jadwal_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'jadwal_nama'  => 'required',
        ];

        if ($this->jadwal_logo_path) {
            $rule['jadwal_logo_path']  = 'required';
        }

        return $this->validate($rule);
    }

    public function getDataById($tbl_jadwal_id)
    {
        $tbl_jadwal = ModelsJadwal::find($tbl_jadwal_id);
        $this->tbl_jadwal_id = $tbl_jadwal->id;
        $this->jadwal_nama = $tbl_jadwal->jadwal_nama;
        $this->jadwal_logo = $tbl_jadwal->jadwal_logo;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($tbl_jadwal_id)
    {
        $tbl_jadwal = ModelsJadwal::find($tbl_jadwal_id);
        $this->tbl_jadwal_id = $tbl_jadwal->id;
    }

    public function toggleForm($form)
    {
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->tbl_jadwal_id = null;
        $this->jadwal_nama = null;
        $this->jadwal_logo = null;
        $this->jadwal_logo_path = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
