<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'fil_created';
    use HasFactory;
    protected $table = 'dokter';

    protected $primaryKey = 'id_dokter';


    protected $fillable = [
        'nama_dokter', 'id_spesialis','jam_praktek', 'jenis_kelamin_d', 'fil_created'
    ];
}
