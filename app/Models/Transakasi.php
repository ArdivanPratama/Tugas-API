<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transakasi extends Model
{
    use HasFactory;
    public $primaryKey = 'id_transaksi';
    public $table = 'transaksis';
    protected $fillable = [
        'id_user', 'nama_transaksi', 'nama_user', 'nama_barang', 'jenis_barang', 'ukuran', 'no_telpon_user'
    ];
}
