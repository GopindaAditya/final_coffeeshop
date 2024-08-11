<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'id_pelanggan', 
        'id_kasirs',
        'status_transaksi',
        'snap_token'
    ];

    static function tambahTransaksi()
    {
        $user = Auth::user()->id;
        $data = Penjualan::create([
            "id_pelanggan" => $user,
            "id_kasirs" => 1,
            "status_transaksi" => "0",
        ]);

        return $data->id;
    }

    public function updateStatus($idPenjualan, $status)
    {
        $penjualan = $this->findOrFail($idPenjualan); // Menggunakan findOrFail untuk mencari penjualan berdasarkan ID

        $penjualan->status = $status; // Mengupdate nilai status

        $penjualan->save(); // Menyimpan perubahan

        return $penjualan; // Mengembalikan objek penjualan yang telah diupdate
    }
}