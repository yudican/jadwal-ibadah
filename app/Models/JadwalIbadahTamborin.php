<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadahTamborin extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ibadah_tamborin';
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
     * Get the petugas that owns the JadwalIbadahSinger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
