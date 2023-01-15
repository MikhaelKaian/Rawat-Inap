<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'hasil';

    protected $primaryKey = 'id_hasil';


    protected $fillable = [
        'id_dokter','id_pasien','kode_pasien', 'alamat', 'lama_inap', 'keterangan', 'tanggal'
    ];
}
