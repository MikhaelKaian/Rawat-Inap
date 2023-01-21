<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Kamar;
class KamarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kamar = Kamar::all();
        return view('kamar', compact('user', 'kamar'));
    }

    public function store(Request $request){
        $validate = $request->all([
            'no_kamar' => 'required|max:20',
            'nama_kamar' => 'required|max:255',
            'kelas_kamar' => 'required',
            'status_kamar' => 'required',
        ]);

        Kamar::Create([
            'no_kamar' => $request->no_kamar,
            'nama_kamar' => $request->nama_kamar,
            'kelas_kamar' => $request->kelas_kamar,
            'status_kamar' => $request->status_kamar,
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
            ]);

            $kamar->no_kamar = $req->get('no_kamar');
            $kamar->nama_kamar = $req->get('nama_kamar');
            $kamar->kelas_kamar = $req->get('kelas_kamar');
            $kamar->status_kamar = $req->get('status_kamar');

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
