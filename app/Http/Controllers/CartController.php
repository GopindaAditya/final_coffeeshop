<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Detail_penjualan;
use App\Models\Produks;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $user = Auth::user();
        return view('customer.detailCart', compact('user'));
    }
    function read()
    {
        $user = Auth::user();
        $data = Cart::where('id_user', $user->id)->get();
        $produk = Produks::whereIn('id', $data->pluck('id_produk'))->get();
        return view('customer.read', compact('data', 'produk'));
    }


    function show($id)
    {
        $data = Produks::find($id);
        return view('customer.shopping-cart', compact('data'));
    }


    function addCart(Request $request, $id)
    {
        $jumlah = $request->input('jumlah');
        $customer = Auth::user()->id;
        $data = new Cart;
        $data->id_user = $customer;
        $data->id_produk = $id;
        $data->harga = $request->harga;
        if ($jumlah <= $request->stok) {
            $data->jumlah = $jumlah;
            $data->save();
            return view('menu');
        } else {
            return redirect()->back()->withErrors("Stok Kurang")->withInput();
        }
    }

    public function hitungHarga(Request $request)
    {
        $ukuran = $request->input('ukuran');
        $jumlah = $request->input('jumlah');
        $idProduk = $request->input('idProduk');

        $produk = Produks::find($idProduk);
        $hargaAwal = $produk->harga;

        if ($ukuran === "medium") {
            $persentase = 5;
        } elseif ($ukuran === "large") {
            $persentase = 10;
        } else {
            $persentase = 0;
        }

        $hargaBaru = $hargaAwal + ($hargaAwal * ($persentase / 100));

        return response()->json(['harga' => $hargaBaru]);
    }


    function cekout(Request $request)
    {
        $id_transaksi = Penjualan::tambahTransaksi();

        if (!is_numeric($id_transaksi)) {
            return response()->json(['error' => 'Invalid id_transaksi'], 400);
        }

        $selectedItems = $request->input('items');
        $items = [];
        foreach ($selectedItems as $itemId) {
            $dataMenu = Cart::find($itemId);
            $total = $dataMenu->harga * $dataMenu->jumlah;
            if (!$dataMenu) {
                return response()->json(['error' => 'Item not found'], 404);
            }

            $items[] = [
                'name' => $dataMenu->id_user,
                'produk' => $dataMenu->id_produk,
                'quantity' => $dataMenu->jumlah,
                'price' => $total,
            ];

            $data = new Detail_penjualan;
            $data->id_transaksi = $id_transaksi; // Assign the valid integer value
            $data->id_menu = $dataMenu->id_produk;
            $data->jumlah = $dataMenu->jumlah;
            $data->harga_penjualan = $total;
            $data->save();

            $produk = Produks::find($data->id_menu);
            $produk->stok = $produk->stok - $dataMenu->jumlah;
            $produk->save();

            $dataMenu->delete();
        }
        $response = ['items' => $items]; // Create a response array with 'items' key
        return response()->json($response); // Send JSON response to the client
    }

    function qrcode(Request $request)
    {
        $qrCodeData = $request->input('data');
        return view('customer.pembayaran', compact('qrCodeData'));
    }

    function destroy(Request $request)
    {
        $selectedItems = $request->input('items');

        foreach ($selectedItems as $itemId) {
            $data = Cart::find($itemId);
            $data->delete();
        }

        return response()->json(['message' => 'Items deleted successfully'], 200);
    }

}