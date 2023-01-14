<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Hasil;
use App\Models\Dokter;
use App\Models\Pasien;
class HasilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hasil = Hasil::all();
        $dokter = Dokter::all();
        $pasien = Pasien::all();
        return view('hasil', compact('user', 'hasil', 'dokter', 'pasien'));
    }

    public function store(Request $request){
        $validate = $request->all([
            'id_dokter' => 'required',
            'id_pasien' => 'required',
            'alamat' => 'required',
            'lama_inap' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
        ]);

        Hasil::Create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => $request->id_pasien,
            'alamat' => $request->alamat,
            'lama_inap' => $request->lama_inap,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
        return('id_hasil')->with($notification);
    }
}
