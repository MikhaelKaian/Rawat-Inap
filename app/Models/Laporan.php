<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'fil_created';
    use HasFactory;
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';


    protected $fillable = [
        'id_pembayaran', 'jenis_tindakan', 'jumlah_p_tindakan', 'jumlah_p_inap', 'total', 'fil_created'
    ];

    public static function getDataPembayaran()
    {
    $pembayaran = Pembayaran::all();

    $pembayaran_filter = [];
    $no = 1;
    for ($i=0; $i < $pembayaran->count(); $i++){ 
        $pembayaran_filter[$i]['no'] = $no++;
        $pembayaran_filter[$i]['id_pembayran'] = $pembayaran_filter[$i]->id_pembayaran;
        $pembayaran_filter[$i]['jenis_tindakan'] = $pembayaran_filter[$i]->jenis_tindakan;
        $pembayaran_filter[$i]['jumlah_p_tindakan'] = $pembayaran_filter[$i]->jumlah_p_tindakan;
        $pembayaran_filter[$i]['jumlah_p_inap'] = $pembayaran_filter[$i]->jumlah_p_inap;
        $pembayaran_filter[$i]['total'] = $pembayaran_filter[$i]->total;
        $pembayaran_filter[$i]['fil_created'] = $pembayaran_filter[$i]->fil_created;
        }
        return $pembayaran_filter;
    }
}
