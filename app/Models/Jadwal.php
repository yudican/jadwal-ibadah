<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    public $table = 'jadwal';

    protected $fillable = ['jadwal_nama', 'jadwal_logo'];

    protected $dates = [];
}
