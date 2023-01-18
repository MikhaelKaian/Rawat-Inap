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

    public static function getDataPasien()
    {
    $pasiens = Pasien::all();

    $pasiens_filter = [];
    $no = 1;
    for ($i=0; $i < $pasiens->count(); $i++){ 
        $pasiens_filter[$i]['no'] = $no++;
        $pasiens_filter[$i]['nama_pasien'] = $pasiens[$i]->nama_pasien;
        $pasiens_filter[$i]['umur_pasien'] = $pasiens[$i]->umur_pasien;
        $pasiens_filter[$i]['tgl_pasien'] = $pasiens[$i]->tgl_pasien;
        $pasiens_filter[$i]['alamat_pasien'] = $pasiens[$i]->alamat_pasien;
        $pasiens_filter[$i]['no_tlp'] = $pasiens[$i]->no_tlp;
        $pasiens_filter[$i]['jenis_kelamin_p'] = $pasiens[$i]->jenis_kelamin_p;
        $pasiens_filter[$i]['tanggal'] = $pasiens[$i]->tanggal;
        }
        return $pasiens_filter;
    }
}
