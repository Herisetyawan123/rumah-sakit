<?php

namespace App\Http\Livewire\Pasien\Konsultasi;

use Livewire\Component;
use App\Models\Konsultasi;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;

class RiwayatKonsultasi extends Component
{
    use WithFileUploads;
    public $listRiwayatKonsul;
    public $imageUpload;

    function mount()
    {
        $this->listRiwayatKonsul = Konsultasi::where('pasien_id',Auth::guard('pasien')->user()->id)->get();

    }

    function getTanggal($date)
    {
        return Carbon::parse($date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y');
    }

    function bayar($id)
    {
        $this->validate([
            'imageUpload' => 'required'
        ]);
        $konsultasi = Konsultasi::findOrFail($id);

        if ($this->imageUpload instanceof TemporaryUploadedFile) {
            $konsultasi->addMedia($this->imageUpload)
                ->toMediaCollection($konsultasi::BUKTI_PEMBAYARAN_KONSULTASI);
        }
        $konsultasi->status_pembayaran = 'menunggu konfirmasi';
        $konsultasi->save();
        return redirect()->route('pasien.riwayat-konsultasi.index')->with('alertType','success')->with('alertMessage','Bukti pembayaran berhasil diperbaharui.');

    }

    public function render()
    {
        return view('pages.pasien.konsultasi.riwayat-konsultasi')
        ->extends('layouts.layout_user')
        ->section('content');
    }
}
