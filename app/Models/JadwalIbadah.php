<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    use HasFactory;

    public $table = 'jadwal_ibadah';

    protected $fillable = ['tanggal', 'key', 'jadwal_id', 'leader_id', 'pembaca_kitab_id', 'pembaca_doa_id'];

    protected $dates = ['tanggal'];

    /**
     * Get all of the singers for the JadwalIbadah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function singers()
    {
        return $this->hasMany(JadwalIbadahSinger::class, 'jadwal_ibadah_id');
    }

    /**
     * Get the leader associated with the JadwalIbadah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function leader()
    {
        return $this->belongsTo(Petugas::class, 'leader_id', 'id');
    }

    /**
     * Get the leader associated with the JadwalIbadah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pembacaKitab()
    {
        return $this->belongsTo(Petugas::class, 'pembaca_kitab_id', 'id');
    }

    /**
     * Get the leader associated with the JadwalIbadah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pembacaDoa()
    {
        return $this->belongsTo(Petugas::class, 'pembaca_doa_id', 'id');
    }

    /**
     * Get the jadwal that owns the JadwalIbadah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
