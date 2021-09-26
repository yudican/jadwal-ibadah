<?php

namespace App\Http\Livewire\Master;

use App\Models\Petugas as ModelsPetugas;
use Livewire\Component;


class Petugas extends Component
{
    
    public $tbl_petugas_id;
    public $petugas_nama;
public $petugas_alamat;
public $petugas_telepon;
    
   

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataById', 'getId'];

    public function render()
    {
        return view('livewire.master.tbl-petugas', [
            'items' => ModelsPetugas::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        
        $data = ['petugas_nama'  => $this->petugas_nama,
'petugas_alamat'  => $this->petugas_alamat,
'petugas_telepon'  => $this->petugas_telepon];

        ModelsPetugas::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = ['petugas_nama'  => $this->petugas_nama,
'petugas_alamat'  => $this->petugas_alamat,
'petugas_telepon'  => $this->petugas_telepon];
        $row = ModelsPetugas::find($this->tbl_petugas_id);

        

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsPetugas::find($this->tbl_petugas_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'petugas_nama'  => 'required',
'petugas_alamat'  => 'required',
'petugas_telepon'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($tbl_petugas_id)
    {
        $tbl_petugas = ModelsPetugas::find($tbl_petugas_id);
        $this->tbl_petugas_id = $tbl_petugas->id;
        $this->petugas_nama = $tbl_petugas->petugas_nama;
$this->petugas_alamat = $tbl_petugas->petugas_alamat;
$this->petugas_telepon = $tbl_petugas->petugas_telepon;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($tbl_petugas_id)
    {
        $tbl_petugas = ModelsPetugas::find($tbl_petugas_id);
        $this->tbl_petugas_id = $tbl_petugas->id;
    }

    public function toggleForm($form)
    {
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->tbl_petugas_id = null;
        $this->petugas_nama = null;
$this->petugas_alamat = null;
$this->petugas_telepon = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
