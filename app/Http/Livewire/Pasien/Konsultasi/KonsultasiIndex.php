<?php

namespace App\Http\Livewire\Pasien\Konsultasi;

use App\Models\Bank;
use App\Models\Dokter;
use Livewire\Component;
use App\Models\Konsultasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KonsultasiIndex extends Component
{
    public $listDokter;
    public $tanggalKonsultasi;
    public $noTelp;
    public $bank;
    public $bankOptions;
    public $search;

    public function mount(){
        $this->getListDokter();
        $this->bankOptions = Bank::pluck('nama_bank','id')->toArray();

    }

    function getListDokter()
    {
        $this->listDokter = $this->search? Dokter::whereLike(['nama'],$this->search)->get():Dokter::all();
    }

    function booking($id)
    {
        $this->validate([
            'bank'=>'required|numeric|exists:banks,id',
            'tanggalKonsultasi' => 'required|date',
            'noTelp' => 'required|numeric'
        ]);
        $dokter = Dokter::findOrFail($id);
        Konsultasi::create([
            'no_pesanan'=>'KO'.Auth::guard('pasien')->user()->id.preg_replace('/[^A-Za-z0-9]+/', '', Carbon::now()),
            'pasien_id'=> Auth::guard('pasien')->user()->id,
            'dokter_id'=> $dokter->id,
            'bank_id' => $this->bank,
            'no_telepon' => $this->noTelp,
            'tanggal_pesanan' => $this->tanggalKonsultasi,
            'tarif' => $dokter->nominal,
            'status_pembayaran' => 'pending',
            'status_konsultasi' => 'belum konsultasi'
        ]);

        return redirect()->route('pasien.riwayat-konsultasi.index');

    }
    public function render()
    {
        return view('pages.pasien.konsultasi.list-konsultasi')
        ->extends('layouts.layout_user')
        ->section('content');
    }
}
