<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function __construct() {
        Auth::shouldUse('kasirs');

        $this->middleware('auth:kasirs');
    }
    function index()
    {
        return view('kasir.menu');
    }

    function read()
    {
        $data = Produks::all();
        return view('kasir.read', compact('data'));
    }

    function search(Request $request)
    {
        $search = $request->input('search');
        $data = Produks::where('name', 'like', "%$search%")->get();
        return view('kasir.read', compact('data'));
    }

    function stok($id)
    {
        $data = Produks::find($id);
        return view('kasir.stok', compact('data'));
    }

    function updateStok(Request $request, $id)
    {
        $data = Produks::find($id);
        $data->stok = $request->stok;
        $data->save();
        return response()->json(['message' => 'Data berhasil disimpan!'], 200);
    }
    
    function addStok($id){
        $data = Produks::find($id);
        if($data){
            $data->stok += 1;
            $data->save();
            return response()->json('Data Stok berhasil ditambahkan', 200);
        }else {
            return response()->json('Menu Tidak ditemukan', 404);
        }
    }

    function minStok($id){
        $data = Produks::find($id);
        if($data){
            $data->stok -=1;
            $data->save();
            return response()->json('Data Stok Dikurang', 200);
        }else{
            return response()->json('Menu Tidak ditemukan', 404);
        }
    }

}