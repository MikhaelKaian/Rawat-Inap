<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'dokter';

    protected $primaryKey = 'id_kamar';


    protected $fillable = [
        'nama_dokter', 'id_spesialis', 'jam_praktek', 'jenis_kelamin', 'tanggal'
    ];
}
