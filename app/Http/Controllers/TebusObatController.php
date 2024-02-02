<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Pasien\Obat\TebusObatKomponen;
use App\Models\TebusObat;
use App\Models\TransaksiObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TebusObatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resep' => 'required',
        ]);

        $imagePath = $request->file('resep')->store('images', 'public');

        $tebus = TransaksiObat::create([
            'pasien_id' => auth()->user()->id,
            'image' => 'storage/'.$imagePath,
            'kode_transaksi' => 'TO'.auth()->user()->id.preg_replace('/[^A-Za-z0-9]+/', '', Carbon::now())
        ]);
     

        return redirect('/pasien/tebus/obat/'.$tebus->id);
    }

    public function createData($id){
        return App::call(TebusObatKomponen::class);
    }
}
