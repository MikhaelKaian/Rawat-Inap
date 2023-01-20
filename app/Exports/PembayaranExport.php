<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PembayaranExport implements FromCollection
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
            'jumlah_p_tindakan',
            'jumlah_p_inap',
            'total',
            'tanggal'
        ];
    }
}
