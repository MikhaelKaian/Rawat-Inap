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
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'alamat' => 'required',
            'lama_inap' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
        ]);

        Hasil::Create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
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
    }

    public function update(Request $req, $id){
            $kamar = Kamar::where("id_kamar","=",$id)->first();

            $validate = $req->validate([
            'no_kamar' => 'required|max:20',
            'nama_kamar' => 'required|max:255',
            'kelas_kamar' => 'required',
            'status_kamar' => 'required',
            'tanggal' => 'required',
            ]);

            $kamar->no_kamar = $req->get('no_kamar');
            $kamar->nama_kamar = $req->get('nama_kamar');
            $kamar->kelas_kamar = $req->get('kelas_kamar');
            $kamar->status_kamar = $req->get('status_kamar');
            $kamar->tanggal = $req->get('tanggal');

            $kamar->save();

        $notification = array(
            'message' => 'Data Kamar berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('kamar')->with($notification);
    }

    public function delete($id){

        $kamar = Kamar::where("id_kamar","=",$id)->delete();

        $notification = array(
            'message' => 'Data Kamar berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('kamar')->with($notification);
        }
}
