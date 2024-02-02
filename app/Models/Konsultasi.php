<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Konsultasi extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    const BUKTI_PEMBAYARAN_KONSULTASI = 'BUKTI_PEMBAYARAN_KONSULTASI';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'konsultasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_pesanan',
        'pasien_id',
        'dokter_id',
        'bank_id',
        'no_telepon',
        'tanggal_pesanan',
        'tarif',
        'status_pembayaran',
        'status_konsultasi'
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

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this::BUKTI_PEMBAYARAN_KONSULTASI)
        ->singleFile()
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);
    }
}
