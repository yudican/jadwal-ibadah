<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\JadwalIbadah;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;
use App\Models\JadwalIbadahSinger;
use App\Models\JadwalIbadahTamborin;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;

class JadwalIbadahDataTable extends LivewireDatatable
{
  protected $listeners = ['refreshTable', 'getJadwalById'];
  public $table_name = 'tbl_jadwal_ibadah';


  public function builder()
  {
    return JadwalIbadah::where('jadwal_id', request()->segment(2));
  }

  public function columns()
  {
    if (request()->segment(2) == 1) {
      return [
        Column::name('tanggal')->label('tanggal')->searchable(),
        Column::name('tempat.tempat_ibadah_nama')->label('Tempat Ibadah')->searchable(),
        Column::callback('leader_id', function ($leader_id) {
          $petugas = Petugas::find($leader_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Worhsip Leader'),
        Column::callback(['tbl_jadwal_ibadah.leader_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
          $singers = JadwalIbadahSinger::where('jadwal_ibadah_id', $id)->get();
          if (count($singers) > 0) {
            $sings = [];
            foreach ($singers as $key =>  $singer) {
              $sings[] = ($key + 1) . '. ' . $singer->penyanyi->petugas_nama;
            }
            return implode('<br/>', $sings);
          }
          return '-';
        })->label('Singer'),
        Column::callback(['tbl_jadwal_ibadah.pembaca_doa_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
          $tamborins = JadwalIbadahTamborin::where('jadwal_ibadah_id', $id)->get();
          if (count($tamborins) > 0) {
            $sings = [];
            foreach ($tamborins as $key =>  $tamborin) {
              $sings[] = ($key + 1) . '. ' . $tamborin->petugas->petugas_nama;
            }
            return implode('<br/>', $sings);
          }
          return '-';
        })->label('Tamborin'),
        Column::name('key')->label('key')->searchable(),
      ];
    } else if (request()->segment(2) == 2) {
      return [
        Column::name('tanggal')->label('tanggal')->searchable(),
        Column::name('jadwal.jadwal_nama')->label('Jadwal')->searchable(),
        Column::callback('leader_id', function ($leader_id) {
          $petugas = Petugas::find($leader_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Worhsip Leader'),
        Column::callback(['tbl_jadwal_ibadah.leader_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
          $singers = JadwalIbadahSinger::where('jadwal_ibadah_id', $id)->get();
          if (count($singers) > 0) {
            $sings = [];
            foreach ($singers as $key =>  $singer) {
              $sings[] = ($key + 1) . '. ' . $singer->penyanyi->petugas_nama;
            }
            return implode('<br/>', $sings);
          }
          return '-';
        })->label('Singer'),
        Column::callback('pembaca_kitab_id', function ($pembaca_kitab_id) {
          $petugas = Petugas::find($pembaca_kitab_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Pembaca 3 Kitab'),
        Column::callback('pembaca_doa_id', function ($pembaca_doa_id) {
          $petugas = Petugas::find($pembaca_doa_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Doa 3 komponen'),
        Column::name('key')->label('key')->searchable()
      ];
    } else if (request()->segment(2) == 3) {
      return [
        Column::name('tanggal')->label('tanggal')->searchable(),
        Column::name('waktu_ibadah')->label('Waktu Ibadah')->searchable(),
        Column::name('tempat.tempat_ibadah_nama')->label('Tempat Ibadah')->searchable(),
        Column::callback('leader_id', function ($leader_id) {
          $petugas = Petugas::find($leader_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Worhsip Leader'),
        Column::name('lagu')->label('Musik')->searchable()
      ];
    } else if (request()->segment(2) == 4) {
      return [
        Column::name('tanggal')->label('tanggal')->searchable(),
        Column::name('waktu_ibadah')->label('Waktu Ibadah')->searchable(),
        Column::name('tempat.tempat_ibadah_nama')->label('Tempat Ibadah')->searchable()
      ];
    } else {
      return [
        Column::name('tanggal')->label('tanggal')->searchable(),
        Column::name('waktu_ibadah')->label('Waktu Ibadah')->searchable(),
        Column::name('tempat.tempat_ibadah_nama')->label('Tempat Ibadah')->searchable(),
        Column::name('lagu')->label('Lagu')->searchable(),
        Column::name('jadwal.jadwal_nama')->label('Jadwal')->searchable(),
        Column::callback('leader_id', function ($leader_id) {
          $petugas = Petugas::find($leader_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Worhsip Leader'),
        Column::callback(['tbl_jadwal_ibadah.leader_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
          $singers = JadwalIbadahSinger::where('jadwal_ibadah_id', $id)->get();
          if (count($singers) > 0) {
            $sings = [];
            foreach ($singers as $key =>  $singer) {
              $sings[] = ($key + 1) . '. ' . $singer->penyanyi->petugas_nama;
            }
            return implode('<br/>', $sings);
          }
          return '-';
        })->label('Singer'),
        Column::callback(['tbl_jadwal_ibadah.pembaca_doa_id', 'tbl_jadwal_ibadah.id'], function ($leader_id, $id) {
          $tamborins = JadwalIbadahTamborin::where('jadwal_ibadah_id', $id)->get();
          if (count($tamborins) > 0) {
            $sings = [];
            foreach ($tamborins as $key =>  $tamborin) {
              $sings[] = ($key + 1) . '. ' . $tamborin->petugas->petugas_nama;
            }
            return implode('<br/>', $sings);
          }
          return '-';
        })->label('Tamborin'),
        Column::callback('pembaca_kitab_id', function ($pembaca_kitab_id) {
          $petugas = Petugas::find($pembaca_kitab_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Pembaca 3 Kitab'),
        Column::callback('pembaca_doa_id', function ($pembaca_doa_id) {
          $petugas = Petugas::find($pembaca_doa_id);
          return $petugas ? $petugas->petugas_nama : '-';
        })->label('Doa 3 komponen'),
        Column::name('key')->label('key')->searchable(),
        Column::callback(['id'], function ($id) {
          return view('livewire.components.action-button', [
            'id' => $id,
            'segment' => request()->segment(1)
          ]);
        })->label(__('Aksi'))
      ];
    }
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
    $this->jadwal_id = $id;
  }

  public function refreshTable()
  {
    $this->emit('refreshLivewireDatatable');
  }
}
