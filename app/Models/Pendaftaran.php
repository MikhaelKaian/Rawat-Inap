<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_kamar';


    protected $fillable = [
        'no_kamar', 'nama_kamar', 'kelas_kamar', 'status_kamar', 'tanggal'
    ];
}
