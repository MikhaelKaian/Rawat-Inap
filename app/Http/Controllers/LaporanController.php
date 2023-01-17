<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use PDF;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('laporan', compact('user', 'laporan'));
    }

    public function print_pasiens()
        {
            $pasiens = Pasien::all();

            $pdf = PDF::loadview('print_pasiens', ['pasien'=>$pasiens])->setPaper('a4', 'landscape');;
            return $pdf->stream('data_pasien.pdf');
        }
}
