<?php

namespace App\Http\Livewire\Master;

use App\Models\TempatIbadah as ModelsTempatIbadah;
use Livewire\Component;


class TempatIbadah extends Component
{
    
    public $tbl_tempat_ibadah_id;
    public $tempat_ibadah_nama;
public $tempat_ibadah_alamat;
    
   

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataById', 'getId'];

    public function render()
    {
        return view('livewire.master.tbl-tempat-ibadah', [
            'items' => ModelsTempatIbadah::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        
        $data = ['tempat_ibadah_nama'  => $this->tempat_ibadah_nama,
'tempat_ibadah_alamat'  => $this->tempat_ibadah_alamat];

        ModelsTempatIbadah::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = ['tempat_ibadah_nama'  => $this->tempat_ibadah_nama,
'tempat_ibadah_alamat'  => $this->tempat_ibadah_alamat];
        $row = ModelsTempatIbadah::find($this->tbl_tempat_ibadah_id);

        

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsTempatIbadah::find($this->tbl_tempat_ibadah_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'tempat_ibadah_nama'  => 'required',
'tempat_ibadah_alamat'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($tbl_tempat_ibadah_id)
    {
        $tbl_tempat_ibadah = ModelsTempatIbadah::find($tbl_tempat_ibadah_id);
        $this->tbl_tempat_ibadah_id = $tbl_tempat_ibadah->id;
        $this->tempat_ibadah_nama = $tbl_tempat_ibadah->tempat_ibadah_nama;
$this->tempat_ibadah_alamat = $tbl_tempat_ibadah->tempat_ibadah_alamat;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($tbl_tempat_ibadah_id)
    {
        $tbl_tempat_ibadah = ModelsTempatIbadah::find($tbl_tempat_ibadah_id);
        $this->tbl_tempat_ibadah_id = $tbl_tempat_ibadah->id;
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
        $this->tbl_tempat_ibadah_id = null;
        $this->tempat_ibadah_nama = null;
$this->tempat_ibadah_alamat = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
