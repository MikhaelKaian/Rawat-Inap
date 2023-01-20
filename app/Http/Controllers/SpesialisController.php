<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Spesialis;
class SpesialisController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $spesialis = Spesialis::all();
        return view('spesialis', compact('user', 'spesialis'));
    }

    public function store(Request $request){
        $validate = $request->all([
            'nama_spesialis' => 'required|max:255',
        ]);


        Spesialis::Create([
            'nama_spesialis' => $request->nama_spesialis,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req, $id){
            $spesialis = Spesialis::where("id_spesialis","=",$id)->first();

            $validate = $req->validate([
                'nama_spesialis' => 'required|max:255',
            ]);

            $spesialis->nama_spesialis = $req->get('nama_spesialis');


            $spesialis->save();

        $notification = array(
            'message' => 'Data spesialis berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('spesialis')->with($notification);
    }

    public function delete($id){

        $spesialis = Spesialis::where("id_spesialis","=",$id)->delete();

        $notification = array(
            'message' => 'Data spesialis berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('spesialis')->with($notification);
        }
}
