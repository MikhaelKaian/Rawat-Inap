<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    public $timestamps = false; 
    const CREATED_AT = 'fil_created';
    use HasFactory;

    protected $table = 'spesialis';
    protected $primaryKey = 'id_spesialis';


    protected $fillable = [
        'nama_spesialis', 'fil_created'
    ];
}
