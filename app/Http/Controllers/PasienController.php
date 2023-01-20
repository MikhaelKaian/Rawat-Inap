<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pasien = Pasien::all();
        return view('pasien', compact('user', 'pasien'));
    }

    public function store(Request $request){
        $validate = $request->all([
            'nama_pasien' => 'required|max:255',
            'umur_pasien' => 'required',
            'tgl_pasien' => 'required',
            'alamat_pasien' => 'required',
            'no_tlp' => 'required',
            'jenis_kelamin_p' => 'required',
            'fil_created' => 'required',
        ]);

        Pasien::Create([
            'kode_pasien' => $request->kode_pasien,
            'nama_pasien' => $request->nama_pasien,
            'umur_pasien' => $request->umur_pasien,
            'tgl_pasien' => $request->tgl_pasien,
            'alamat_pasien' => $request->alamat_pasien,
            'no_tlp' => $request->no_tlp,
            'jenis_kelamin_p' => $request->jenis_kelamin_p,
            'fil_created' => $request->fil_created,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req, $id){
        $pasien = Pasien::where("id_pasien","=",$id)->first();

        $validate = $req->validate([
            'nama_pasien' => 'required|max:255',
            'umur_pasien' => 'required',
            'tgl_pasien' => 'required',
            'alamat_pasien' => 'required',
            'no_tlp' => 'required',
            'jenis_kelamin_p' => 'required',
        ]);

        $pasien->nama_pasien = $req->get('nama_pasien');
        $pasien->umur_pasien = $req->get('umur_pasien');
        $pasien->tgl_pasien = $req->get('tgl_pasien');
        $pasien->alamat_pasien = $req->get('alamat_pasien');
        $pasien->no_tlp = $req->get('no_tlp');
        $pasien->jenis_kelamin_p = $req->get('jenis_kelamin_p');

        $pasien->save();

    $notification = array(
        'message' => 'Data Pasien berhasil diubah',
        'alert-type' => 'success'
    );

    return redirect('pasien')->with($notification);
}
    public function delete($id){

        $pasien = Pasien::where("id_pasien","=",$id)->delete();

        $notification = array(
            'message' => 'Data Pasien berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('pasien')->with($notification);
        }
}
