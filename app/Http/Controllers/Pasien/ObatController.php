<?php

namespace App\Http\Controllers\Pasien;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Pasien\PemesananObat\PemesananObat;
use App\Http\Livewire\Pasien\PemesananObat\RiwayatPemesananObat;
use App\Http\Livewire\Pasien\PemesananObat\TebusObat;

class ObatController extends Controller
{
    // takgabung satu controller

    public function pesan_obat_index()
    {
        // return view("pages.pasien.obat.obat-index")->with([
        //     "obats" => Obat::with(["KategoriObat", "media"])->get()
        // ]);
        return App::call(PemesananObat::class);
    }

    public function tebus_obat_index()
    {
        return App::call(TebusObat::class);
    }

    public function riwayat_tebus_obat_index()
    {
        return App::call(RiwayatPemesananObat::class);
    }
}
