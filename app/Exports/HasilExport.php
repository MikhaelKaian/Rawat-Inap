<?php

namespace App\Exports;

use App\Models\Hasil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Laporan;
class HasilExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hasil::all();
    }

    public function array (): array
    {
        return Pasien::getDataHasil();
    }

    public function headings (): array
    {
        return [
            'id_hasil',
            'id_dokter',
            'id_pasien',
            'kode_pasien',
            'alamat',
            'lama_inap',
            'keterangan',
            'tanggal',
        ];
    }
}
