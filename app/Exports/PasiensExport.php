<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Laporan;
    
class PasiensExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pasien::all();
    }

    public function array (): array
    {
        return Pasien::getDataPasien();
    }

    public function headings (): array
    {
        return [
            'id_pasien',
            'nama_pasien',
            'umur_pasien',
            'tgl_pasien',
            'alamat_pasien',
            'no_tlp',
            'jenis_kelamin_p',
            'tanggal'
        ];
    }
}