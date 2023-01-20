<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';

    protected $primaryKey = 'id_kamar';


    protected $fillable = [
        'no_kamar', 'nama_kamar', 'kelas_kamar', 'status_kamar'
    ];
}
