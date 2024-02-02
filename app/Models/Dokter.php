<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Dokter extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,InteractsWithMedia;

    protected $guard_name = 'dokter';
    protected $guard = 'dokter';

    CONST FOTO_DOKTER = 'FOTO_DOKTER';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'umur',
        'spesialisasi',
        'jam_kerja_start',
        'jam_kerja_end',
        'nominal',
        'no_telepon',
        'password',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['images'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'media'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this::FOTO_DOKTER)
        ->singleFile()
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);
    }

    public function getImagesAttribute()
    {
        $media = $this->getMedia($this::FOTO_DOKTER);

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
