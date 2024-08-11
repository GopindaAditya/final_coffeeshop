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
        $pen->save();        
        
        if($request->status_transaksi=='1'){
            $user = User::find($pen->id_pelanggan);
            $data = Detail_penjualan::where('id_transaksi', $pen->id)
            ->join('Produks', 'Detail__penjualan.id_menu', '=', 'Produks.id')
            ->select('Detail__penjualan.id_transaksi', 'Detail__penjualan.id_menu', 'Produks.name', 'Detail__penjualan.jumlah', 'Detail__penjualan.size', 'Detail__penjualan.harga_penjualan')
            ->get();
        
            $message = 'JAMUNE BIYUNG
Wedomartani, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta
085738815164

Nomer Nota: ' . $pen->id . '

Kasir: ' . $kasirId->name . '

Pelanggan Yth: ' . $user->name . '

Tanggal: ' . $pen->updated_at . '

======================
Detail pesanan:';
            $total = 0;
            foreach($data as $item){
                $total += $item->harga_penjualan;
                  
                $message .= '
✅ ' . $item->name . '
Harga: Rp ' . number_format($item->harga_penjualan/$item->jumlah,0,',','.') . '
Size : '. $item->size. '
Jumlah: ' . $item->jumlah . '
Total: ' . number_format($item->harga_penjualan, 0, ',', '.');
            }

            $message .= '
=================
Detail biaya:
Total tagihan: Rp' . number_format($total, 0, ',', '.') . '

Pembayaran:
<<<<<<
=======
💵 Tunai Rp' . number_format($total, 0, ',', '.') . '
>>>>>>> 

Status: Lunas
=================

Terima kasih';
        
        // Kirim pesan ke pelanggan (gunakan curl atau metode pengiriman pesan lainnya)
        // Contoh menggunakan curl:
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
                'message' => $message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Ph2GJQCYaeAs7yCy8HTW' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Setelah mengirim pesan, berikan respons kepada pengguna atau lakukan tindakan lainnya
        return response()->json('update status sukses', 200);

        } else {                        
            $details = Detail_penjualan::where('id_transaksi', $pen->id)->get();
            foreach ($details as $detail) {
                $menu = Produks::find($detail->id_menu);                
                $menu->stok += $detail->jumlah;
                $menu->save();
        }
        
        Detail_Penjualan::where('id_transaksi', $pen->id)->delete();

        return response()->json('pesanan ditolak', 200);
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
    
    public function showUploadBukti(){
        return view('customer.uploadBukti');
    }

    public function uploadBukti(Request $request){
        $request->validate([            
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]); 
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Buat nama unik untuk gambar
            $image->storeAs('public/', $imageName); // Simpan gambar ke direktori yang diinginkan
        } else {
            return response()->json(['message' => 'Gambar produk wajib diunggah!'], 422);
        }
        
        $data = Penjualan::find($request->id_transaksi);
        if(!$data){
            return response()->json("Data not found", 404);
        }else{
            $data->bukti_tf = $imageName;
            $data->save();
            return response()->json("success upload bukti", 200);
        }
    }
    public function showBukti($id){
        $data = Penjualan::find($id);
        return view('kasir.buktiPembayara', compact('data'));
    }
}