<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadahSinger extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the jadwalIbadah that owns the JadwalIbadahSinger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwalIbadah()
    {
        return $this->belongsTo(JadwalIbadah::class, 'jadwal_ibadah_id');
    }

    /**
     * Get the penyanyi that owns the JadwalIbadahSinger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penyanyi()
    {
        return $this->belongsTo(Petugas::class, 'penyanyi_id');
    }
}
