<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Dokter;
use App\Models\Spesialis;
class DokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::all();
        $spesialis = Spesialis::all();
        return view('dokter', compact('user', 'dokter','spesialis'));
    }

    public function store(Request $request){

        $validate = $request->all([
            'nama_dokter' => 'required|max:20',
            'id_spesialis' => 'required|max:255',
            'jam_praktek' => 'required',
            'jenis_kelamin_d' => 'required',
            'fil_created' => 'required',
        ]);

        Dokter::Create([
            'nama_dokter' => $request->nama_dokter,
            'id_spesialis' => $request->id_spesialis,
            'jam_praktek' => $request->jam_praktek,
            'jenis_kelamin_d' => $request->jenis_kelamin_d,
            'fil_created' => $request->fil_created
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req, $id){
        $dokter = Dokter::where("id_dokter","=",$id)->first();
        $validate = $req->validate([
            'nama_dokter' => 'required|max:255',
            'id_spesialis' => 'required',
            'jam_praktek' => 'required',
            'jenis_kelamin_d' => 'required',
        ]);

        $dokter->nama_dokter = $req->get('nama_dokter');
        $dokter->id_spesialis = $req->get('id_spesialis');
        $dokter->jam_praktek = $req->get('jam_praktek');
        $dokter->jenis_kelamin_d = $req->get('jenis_kelamin_d');

        $dokter->save();

        $notification = array(
            'message' => 'Data Dokter berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('dokter')->with($notification);
    }

    public function delete($id){

        $dokter = Dokter::where("id_dokter","=",$id)->delete();

        $notification = array(
            'message' => 'Data Dokter berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('dokter')->with($notification);
        }
}
