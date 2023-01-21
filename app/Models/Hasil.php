<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $table = 'hasil';

    protected $primaryKey = 'id_hasil';


    protected $fillable = [
        'id_dokter','id_pasien','kode_pasien', 'alamat', 'lama_inap', 'keterangan', 'tindak_lanjut', 'created_at'
    ];

    public static function getDataHasil()
    {
    $hasil = Hasil::all();

    $hasil_filter = [];
    $no = 1;
    for ($i=0; $i < $hasil->count(); $i++){
        $hasil_filter[$i]['no'] = $no++;
        $hasil_filter[$i]['id_dokter'] = $hasil[$i]->id_dokter;
        $hasil_filter[$i]['id_pasien'] = $hasil[$i]->id_pasien;
        $hasil_filter[$i]['kode_pasien'] = $hasil[$i]->kode_pasien;
        $hasil_filter[$i]['alamat'] = $hasil[$i]->alamat;
        $hasil_filter[$i]['lama_inap'] = $hasil[$i]->lama_inap;
        $hasil_filter[$i]['keterangan'] = $hasil[$i]->keterangan;
        $hasil_filter[$i]['tanggal'] = $hasil[$i]->tanggal;
        $hasil_filter[$i]['create_at'] = $hasil[$i]->create_at;
        }
        return $hasil_filter;
    }
}
