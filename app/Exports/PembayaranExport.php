<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Laporan;

class PembayaranExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pembayaran::all();
    }

    public function array (): array
    {
        return Pembayaran::getDataPembayaran();
    }

    public function headings (): array
    {
        return [
            'id_pembayaran',
            'jenis_tindakan',
            'biaya_periksa',
            'biaya_rawat',
            'total',
            'tanggal'
        ];
    }
}
