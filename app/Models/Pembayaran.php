<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';


    protected $fillable = [
        'jenis_tindakan','biaya_periksa', 'biaya_rawat', 'total', 'created_at'
    ];

    public static function getDataPembayaran()
    {
    $pembayaran = Pembayaran::all();

    $pembayaran_filter = [];
    $no = 1;
    for ($i=0; $i < $pembayaran->count(); $i++){ 
        $pembayaran_filter[$i]['no'] = $no++;
        $pembayaran_filter[$i]['id_pembayaran'] = $pembayaran_filter[$i]->id_pembayaran;
        $pembayaran_filter[$i]['jenis_tindakan'] = $pembayaran_filter[$i]->jenis_tindakan;
        $pembayaran_filter[$i]['biaya_periksa'] = $pembayaran_filter[$i]->biaya_periksa;
        $pembayaran_filter[$i]['biaya_rawat'] = $pembayaran_filter[$i]->biaya_rawat;
        $pembayaran_filter[$i]['total'] = $pembayaran_filter[$i]->total;
        $pembayaran_filter[$i]['created_at'] = $pembayaran_filter[$i]->created_at;
        }
        return $pembayaran_filter;
    }
}
