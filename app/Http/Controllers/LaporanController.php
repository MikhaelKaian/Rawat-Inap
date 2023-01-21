<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Hasil;
use PDF;
use App\Models\Laporan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasiensExport;
use App\Exports\HasilExport;
use App\Exports\PembayaranExport;
use App\Imports\PasiensImport;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('laporan', compact('user', 'laporan'));
    }

    // Print PDF Laporan Pasien

    public function print_pasiens()
        {
            $pasiens = Pasien::all();

            $pdf = PDF::loadview('print_pasiens', ['pasien'=>$pasiens])->setPaper('a4', 'landscape');;
            return $pdf->stream('data_pasien.pdf');
        }

    // Print PDF Laporan Hasil Periksa

    public function print_hasil()
    {
        $hasil = Hasil::all();

        $pdf = PDF::loadview('print_hasil', ['hasil'=>$hasil])->setPaper('a4', 'landscape');;
        return $pdf->stream('data_hasil.pdf');
    }

    public function print_pembayaran()
    {
        $pembayaran = Pembayaran::all();

        $pdf = PDF::loadview('print_pembayaran', ['pembayaran'=>$pembayaran])->setPaper('a4', 'landscape');;
        return $pdf->stream('data_pembayaran.pdf');
    }
    
    // Export Laporan Pasien
    public function pasienexport()
        {
            return Excel::download(new PasiensExport, 'pasiens.xlsx');
        }
    
    // Export Laporan Hasil
        public function hasilexport()
        {
           
            return Excel::download(new HasilExport, 'hasil.xlsx');
        }    
    
        public function pembayaranexport()
        {
           
            return Excel::download(new PembayaranExport, 'pembayaran.xlsx');
        }    

        public function import (Request $req)
        {
            Excel::import(new PasiensImport, $req->file('file'));

            $notification = array (
                'message'   => 'Import data berhasil dilakukan',
                'alert-type'   => 'success',
            );

            return redirect()->route('admin.laporan.import')->with($notification);
        }
}
