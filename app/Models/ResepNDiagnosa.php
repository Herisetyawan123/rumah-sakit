<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepNDiagnosa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resep_n_diagnosa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_transaksi',
        'pasien_id',
        'dokter_id',
        'tarif',
        'resep',
        'diagnosa'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class,'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class,'dokter_id');
    }
}
