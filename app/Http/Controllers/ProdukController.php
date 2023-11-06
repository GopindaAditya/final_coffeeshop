<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use Laraindo\RupiahFormat;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index() {
        return view('menu');
    }
    function read() {
        $data = Produks::all();
        foreach ($data as $menu){
            $harga = RupiahFormat::currency($menu->harga);
            $menu->hargaP = $harga;
        }
        return view('read', compact('data'));
    }

    function search(Request $request){
        $menu = $request->input('search');
        $data = Produks::where('name', 'like', "%$menu%")->get();
        return view('read', compact('data'));
    }

    function ownerMenu() {
        $data = Produks::all();
        return view('owner.menu', compact('data'));
    }
}
