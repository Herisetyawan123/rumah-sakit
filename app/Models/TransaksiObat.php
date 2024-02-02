<?php

namespace App\Models;

use App\Models\DetailTransaksiObat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TransaksiObat extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    const BUKTI_PEMBAYARAN = 'BUKTI_PEMBAYARAN_OBAT';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi_obat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_transaksi',
        'tanggal_pemesanan',
        'pasien_id',
        'status_pembayaran',
        'status_pengambilan',
        'image',
        'status_proses',
        'metode_pembayaran'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total_harga','images'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this::BUKTI_PEMBAYARAN)
        ->singleFile()
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);
    }

    public function getImagesAttribute()
    {
        $media = $this->getMedia($this::BUKTI_PEMBAYARAN);

        return $media->map(function ($item) {
            return [
                'file_name'  => $item->file_name,
                'file_type'  => $item->mime_type,
                'file_size'  => $item->size,
                'url'        => $item->getUrl(),
            ];
        });
    }

    public function getTotalHargaAttribute(): int
    {
        $detailTransaksi = $this->detailTransaksi()->get();
        $total = 0;

        foreach ($detailTransaksi as $key => $value) {
            $total += $value->jumlah*$value->harga_saat_ini;
        }

        return $total;
    }

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

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksiObat::class, 'transaksi_obat_id');
    }

    
}
