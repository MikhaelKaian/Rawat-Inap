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
        'jenis_tindakan','biaya_periksa', 'biaya_rawat', 'total'
    ];
}
