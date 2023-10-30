<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use Illuminate\Http\Request;
use App\Models\Detail_penjualan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;

class OwnerController extends Controller
{
    public function __construct() {
        Auth::shouldUse('owners');
        $this->middleware('auth:owners');
    }
    function index(){
        return view('owner.menu');
    }
    function read() {
        $data = Produks::all();
        return view('owner.read', compact('data'));
    }

    function search(Request $request)  {
        $menu = $request->input('search');
        $data = Produks::where('name', 'like', "%$menu%")->get();        
        return view('owner.read', compact('data'));
    }
    function create() {
        return view('owner.create');
    }
    function addProduk(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'desc' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan validasi tambahan untuk gambar?
        ]);        
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Buat nama unik untuk gambar
            $image->storeAs('public/', $imageName); // Simpan gambar ke direktori yang diinginkan
        } else {
            return response()->json(['message' => 'Gambar produk wajib diunggah!'], 422);
        }
    
        $data = new Produks();
        $data->name = $request->name;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->kategori = $request->kategori;
        $data->desc = $request->desc;
        $data->foto = $imageName; // Simpan nama gambar ke dalam kolom 'foto' di tabel
    
        $data->save();
    
        return response()->json(['message' => 'Data berhasil disimpan!']);
    }    

    function show($id) {
        $data = Produks::find($id);
        return view('owner.edit', compact('data'));        
    }

    function update(Request $request, $id) {
        try {                
            $request->validate([                
                'stok' => 'required|integer',                
            ]);
            $data = Produks::find($id);
            $data -> name=$request->name;
            $data -> harga=$request->harga;
            $data -> stok=$request->stok;
            $data -> desc=$request->desc;   
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Buat nama unik untuk gambar
                $image->storeAs('public/', $imageName); // Simpan gambar ke direktori yang diinginkan
                $data->foto = $imageName; // Simpan nama gambar ke dalam kolom 'foto' di tabel        
            }                 
            $data -> save();
            return response()->json(['message' => 'Data berhasil disimpan!'], 200);
            // return new JsonResponse(200, "sukses");
        } catch (\Throwable $th) {
            return new JsonResponse(400, $th->getMessage());
            // return $th->getMessage();
        }
        
        // dd($data);
        // return response()->json(['message' => 'Data berhasil disimpan!']);
        // return response()->json(['message' => $data]);
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

    function destroy($id){
        $data = Produks::find($id);
        $data -> delete();
    }
    
    public function laporan() {
        $penjualanData = [];     
        $penjualanProduk = [];
        $menu = Produks::all();        
        foreach ($menu as $produk) {
            // Mengambil total penjualan untuk setiap produk dari tabel detail_penjualan
            $totalPenjualan = Detail_penjualan::where('id_menu', $produk->id)->sum('jumlah');
            $penjualanProduk[] = $totalPenjualan;
        }
        $data = Detail_penjualan::selectRaw('DATE(updated_at) as tanggal, COUNT(*) as jumlah_transaksi')
                                ->groupBy('tanggal')
                                ->get();
        foreach ($data as $key) {            
            $penjualanData[] = ['x' => strtotime($key->tanggal) * 1000, 'y' => $key->jumlah_transaksi];            
        }        
        return view('owner.laporan', compact('penjualanData', 'menu', 'penjualanProduk'));
    }
}   
