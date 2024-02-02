<?php

namespace App\Http\Controllers\Pasien;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Pasien\Konsultasi\KonsultasiIndex;
use App\Http\Livewire\Pasien\Konsultasi\RiwayatKonsultasi;

class KonsultasiController extends Controller
{
    public function konsultasi_index()
    {
        return App::call(KonsultasiIndex::class);
    }

    public function riwayat_konsultasi_index()
    {
        return App::call(RiwayatKonsultasi::class);
    }
}
