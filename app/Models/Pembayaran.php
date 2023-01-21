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
        'jenis_tindakan','biaya_periksa', 'biaya_rawat', 'total', 'created_at',
    ];

    public static function getDataPembayaran()
    {
    $pembayarans = Pembayaran::all();

    $pembayarans_filter = [];
    $no = 1;
    for ($i=0; $i < $pembayarans->count(); $i++){
        $pembayarans_filter[$i]['no'] = $no++;
        $pembayarans_filter[$i]['jenis_tindakan'] = $pembayarans[$i]->jenis_tindakan;
        $pembayarans_filter[$i]['biaya_periksa'] = $pembayarans[$i]->biaya_periksa;
        $pembayarans_filter[$i]['biaya_rawat'] = $pembayarans[$i]->biaya_rawat;
        $pembayarans_filter[$i]['total'] = $pembayarans[$i]->total;
        $pembayarans_filter[$i]['created_at'] = $pembayarans[$i]->created_at;
        }
        return $pembayarans_filter;
    }
}
