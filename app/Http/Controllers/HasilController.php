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
        ]);

        Hasil::Create([
            'kode_pasien' => $request->kode_pasien,
            'id_dokter' => $request->id_dokter,
            'id_pasien' => $request->id_pasien,
            'alamat' => $request->alamat,
            'lama_inap' => $request->lama_inap,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Hasil periksan berhasil di simpan, ingat kode pasie : '.$request->kode_pasien);
    }
}
