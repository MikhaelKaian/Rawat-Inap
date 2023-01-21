<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Hasil;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Kamar;
use App\Models\Rawat;

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

            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'id_kamar' => 'required',
            'tanggal_inap' => 'required',
            'tanggal_inap_selesai' => 'required',
        ]);

        Rawat::Create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'id_kamar' => $request->id_kamar,
            'tanggal_inap' => $request->tanggal_inap,
            'tanggal_inap_selesai' => $request->tanggal_inap_selesai,
        ]);

        return response()->json(["message"=> "Data berhasil Di simpan"], 200);
    }
}
