<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
<<<<<<< HEAD
    use HasFactory;
=======
    public $timestamps = false;
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_spesialis';


    protected $fillable = [
        'nama_spesialis', 'tanggal'
    ];
>>>>>>> accd5543354f3370d83f4e019ebb4c45592ace61
}
