<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pembayaran;
class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::all();
        return view('pembayaran', compact('user', 'pembayaran'));
    }

    public function store(Request $request){
        $validate = $request->all([
            'jenis_tindakan' => 'required',
            'biaya_periksa' => 'required',
            'biaya_rawat' => 'required',
            'total' => 'required',
        ]);

        Pembayaran::Create([
            'jenis_tindakan' => $request->jenis_tindakan,
            'biaya_periksa' => $request->biaya_periksa,
            'biaya_rawat' => $request->biaya_rawat,
            'total' => $request->total,
        ]);

        return response()->json(["message"=> "Data berhasil Di simpan"], 200);
    }
}
