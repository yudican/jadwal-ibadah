<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatIbadah extends Model
{
    use HasFactory;

    public $table = 'tempat_ibadah';

    protected $fillable = ['tempat_ibadah_nama', 'tempat_ibadah_alamat'];

    protected $dates = [];
}
