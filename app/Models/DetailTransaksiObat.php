<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiObat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_transaksi_obat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaksi_obat_id',
        'obat_id',
        'harga_saat_ini', 
        'tinggi', 
        'berat', 
        'riwayat_alergi', 
        'alamat', 
        'detail_lokasi', 
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiObat::class,'transaksi_obat_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class,'obat_id');
    }
}
