<?php

namespace App\Imports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class PasiensImport implements WithHeadingRow, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pasien([ 
            'kode_pasien'   => $row['kode_pasien'],
            'nama_pasien'   => $row['nama_pasien'],
            'umur_pasien'   => $row['umur_pasien'],
            'tgl_pasien'   => $row['tgl_pasien'],
            'alamat_pasien'   => $row['alamat_pasien'],
            'no_tlp'   => $row['no_tlp'],
            'jenis_kelamin_p'   => $row['jenis_kelamin_p'],
            'tanggal'   => $row['tanggal'],
        ]);
    }
}
