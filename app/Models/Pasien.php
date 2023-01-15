<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';


    protected $fillable = [
        'kode_pasien','nama_pasien', 'umur_pasien','tgl_pasien','alamat_pasien','no_tlp','jenis_kelamin_p','tanggal'
    ];
}
