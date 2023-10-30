<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produks;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Detail_penjualan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PenjualanController extends Controller
{
    function index()
    {
        return view('kasir.detailPesanan');
    }

    function read()
    {
        $penjualanData = [];

        $pen = Penjualan::where('status_transaksi', '0')->get();

        foreach ($pen as $key) {
            $cusName = User::find($key->id_pelanggan);
            $dataMenu = Detail_penjualan::where('id_transaksi', $key->id)->get();

            if ($cusName && $dataMenu) {
                $penjualanData[] = [
                    'customer' => $cusName,
                    'penjualan' => $key,
                    'detail_penjualan' => $dataMenu,
                ];
            }
        }
        return view('kasir.pesanan', compact('penjualanData'));
    }

    function confirm(Request $request, $id)
    {
        $kasirId = Auth::guard('kasirs')->user();
        $pen = Penjualan::find($id);
        $pen->id_kasirs = $kasirId->id;
        $pen->status_transaksi = $request->status_transaksi;
        $data = Detail_penjualan::where('id_transaksi', $pen->id)->first();
        $pen->save();
        $user = User::find($pen->id_pelanggan);
        $menu = Produks::find($data->id_menu);
        $total = $data->harga_penjualan*$data->jumlah;
        foreach ($data as $pesanan){
        if ($request->status_transaksi == '1') {            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $user->telepon,
                    'message' => 'COFFEE MAS BROO
Jl. Paingan, Krodan, Maguwoharjo, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta
085738815164
                    
Nomer Nota : '
.$pen->id. '
                    
Kasir : '
.$kasirId->name.'
                    
Pelanggan Yth : '
.$user->name. '
                    
Tanggal :'. $pen->updated_at .'
                    
                    
======================
Detail pesanan: 
                    
✅'. $menu ->name. '
  '. $data ->harga_penjualan. '
  '. $data ->jumlah.'
                      
Ket : 
                    
==============
Detail biaya : 
Total tagihan : Rp'.$total.'
                    
Pembayaran: 
💵 Tunai Rp'.$total.'
                    
Status: Lunas
=================
                    
Terima kasih',
                    'countryCode' => '62',
                    //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Ph2GJQCYaeAs7yCy8HTW' //change TOKEN to your actual token
                ),
            )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            return response()->json('update status sukses', 200);
        } else {            
            $stok = $menu->stok + $data->jumlah;
            $menu->stok = $stok;
            $menu->save();
            Detail_Penjualan::where('id_transaksi', $pen->id)->delete();
            return response()->json('pesanan ditolak', 200);
        }
    }
    }

    function nota()
    {
        return view('kasir.nota.nota');
    }
    function readNota()
    {
        $pen = Penjualan::where('status_transaksi', '1')->get();
        // return response()->json($pen, 200);
        return view('kasir.nota.read', compact('pen'));
    }

    function cetakNota($id)
    {
        $pen = Penjualan::find($id);
        $data = Detail_penjualan::where('id_transaksi', $pen->id)->first();
        $menu = Produks::find($data->id_menu);
        return view('kasir.detailNota', compact('pen', 'data', 'menu'));
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