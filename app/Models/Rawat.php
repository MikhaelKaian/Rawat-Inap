<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawat extends Model
{
    use HasFactory;
    protected $table = 'rawat';

    protected $primaryKey = 'id_rawat';


    protected $fillable = [
        'id_dokter', 'id_kamar', 'lama_inap','tanggal_inap', 'tanggal_inap_selesai', 'fil_created'
    ];
}
