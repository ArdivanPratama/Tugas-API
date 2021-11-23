<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $primaryKey = 'id_barang';
    protected $guarded = [];

    public function kategory_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id', 'id');
    }
}
