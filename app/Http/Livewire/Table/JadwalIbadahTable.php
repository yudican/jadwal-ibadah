<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\JadwalIbadah;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;
use App\Models\JadwalIbadahSinger;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;

class JadwalIbadahTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable', 'getJadwalById'];
    public $hideable = null;
    public $table_name = 'tbl_jadwal_ibadah';
    public $hide = [];
    public $jadwal_id = null;


    public function builder()
    {
        if (request()->segment(2)) {
            return JadwalIbadah::query()->where('jadwal_id', request()->segment(2));
        }
        return JadwalIbadah::query();
    }

    public function columns()
    {
        if (Auth::check()) {
            $this->hideable = 'select';
            $this->hide = HideableColumn::where(['table_name' => $this->table_name, 'user_id' => auth()->user()->id])->pluck('column_name')->toArray();
        }
        $data = [
            Column::name('tanggal')->label('tanggal')->searchable(),
            Column::name('jadwal.jadwal_nama')->label('Jadwal')->searchable(),
            Column::callback('leader_id', function ($leader_id) {
                return Petugas::find($leader_id)->petugas_nama;
            })->label('Worhsip Leader'),
            Column::callback(['tbl_jadwal_ibadah.leader_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
                $singers = JadwalIbadahSinger::where('jadwal_ibadah_id', $id)->get();
                $sings = [];
                foreach ($singers as $key =>  $singer) {
                    $sings[] = ($key + 1) . '. ' . $singer->penyanyi->petugas_nama;
                }
                return implode('<br/>', $sings);
            })->label('Singer'),
            Column::callback('pembaca_kitab_id', function ($pembaca_kitab_id) {
                return Petugas::find($pembaca_kitab_id)->petugas_nama;
            })->label('Pembaca 3 Kitab'),
            Column::callback('pembaca_doa_id', function ($pembaca_doa_id) {
                return Petugas::find($pembaca_doa_id)->petugas_nama;
            })->label('Doa 3 komponen'),
            Column::name('key')->label('key')->searchable(),
        ];

        if (!request()->segment(2)) {
            $data[7] = Column::callback(['id'], function ($id) {
                return view('livewire.components.action-button', [
                    'id' => $id,
                    'segment' => request()->segment(1)
                ]);
            })->label(__('Aksi'));
        }

        return $data;
    }

    public function getDataById($id)
    {
        $this->emit('getDataById', $id);
    }

    public function getId($id)
    {
        $this->emit('getId', $id);
    }

    public function getJadwalById($id)
    {
        dd($id);
        $this->jadwal_id = $id;
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }

    public function toggle($index)
    {
        if ($this->sort == $index) {
            $this->initialiseSort();
        }

        $column = HideableColumn::where([
            'table_name' => $this->table_name,
            'column_name' => $this->columns[$index]['name'],
            'index' => $index,
            'user_id' => auth()->user()->id
        ])->first();

        if (!$this->columns[$index]['hidden']) {
            unset($this->activeSelectFilters[$index]);
        }

        $this->columns[$index]['hidden'] = !$this->columns[$index]['hidden'];

        if (!$column) {
            HideableColumn::updateOrCreate([
                'table_name' => $this->table_name,
                'column_name' => $this->columns[$index]['name'],
                'index' => $index,
                'user_id' => auth()->user()->id
            ]);
        } else {
            $column->delete();
        }
    }
}
