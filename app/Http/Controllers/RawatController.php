<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Hasil;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Kamar;

class RawatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kamar = Kamar::all();
        $dokter = Dokter::all();
        $hasil = Hasil::all();
        $pasien = Pasien::all();
        return view('rawat', compact('user', 'kamar', 'dokter', 'hasil', 'pasien'));
    }

    public function store(Request $request){
        $validate = $request->all([

            'id_dokter' => 'required',
            'id_kamar' => 'required',
            'lama_inap' => 'required',
            'tanggal_inap' => 'required',
            'tanggal_inap_selesai' => 'required',
            'tanggal' => 'required',
        ]);

        // Rawat::Create([
        //     'id_dokter' => $request->id_dokter,
        //     'id_kamar' => $request->id_kamar,
        //     'lama_inap' => $request->lama_inap,
        //     'tanggal_inap' => $request->tanggal_inap,
        //     'tanggal_inap_selesai' => $request->tanggal_inap_selesai,
        //     'tanggal' => $request->tanggal
        // ]);

        return redirect()->back()->with('success', 'Hasil Rawat berhasil di simpan');
    }
}
