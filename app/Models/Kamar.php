<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    public $timestamps = false; 
    const CREATED_AT = 'fil_created';
    use HasFactory;
    protected $table = 'kamar';

    protected $primaryKey = 'id_kamar';


    protected $fillable = [
        'no_kamar', 'nama_kamar', 'kelas_kamar', 'status_kamar', 'fil_created'
    ];
}
