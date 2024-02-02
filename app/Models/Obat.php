<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Obat extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    const FOTO_OBAT = 'FOTO_OBAT';
    protected $table = "obat";
    protected $guarded = ["id"];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['media'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['images'];

    public function KategoriObat()
    {
        return $this->belongsTo(KategoriObat::class, "kategori_obat");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this::FOTO_OBAT)
        ->singleFile()
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);
    }

    public function getImagesAttribute()
    {
        $media = $this->getMedia($this::FOTO_OBAT);

        return $media->map(function ($item) {
            return [
                'file_name'  => $item->file_name,
                'file_type'  => $item->mime_type,
                'file_size'  => $item->size,
                'url'        => $item->getUrl(),
            ];
        });
    }
}
