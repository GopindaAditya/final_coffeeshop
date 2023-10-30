<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_penjualan extends Model
{
    use HasFactory;

    protected $table = 'detail__penjualan';

    protected $fileable = [
        'id_transaksi',
        'id_menu',
        'jumlah', 
        'harga_penjualan',
    ];
}

