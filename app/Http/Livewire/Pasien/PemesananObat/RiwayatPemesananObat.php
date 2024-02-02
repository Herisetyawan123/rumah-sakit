<?php

namespace App\Http\Livewire\Pasien\PemesananObat;

use App\Models\Bank;
use Livewire\Component;
use App\Models\TransaksiObat;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;

class RiwayatPemesananObat extends Component
{
    use WithFileUploads;
    public $listTransaksi;
    public $bankOptions = [];
    public $detailTransaksi;
    public $bank;
    public $selectBank;
    // public $image;
    public $imageUpload;
    protected $listeners = ['refreshComponent' => '$refresh'];

    function mount()
    {
        $this->listTransaksi = TransaksiObat::where('pasien_id',Auth::guard('pasien')->user()->id)->where('status_pembayaran','lunas')->get();
        $this->bankOptions = Bank::pluck('nama_bank','id')->toArray();
        $this->bank = Bank::first();

    }

    function setBank()
    {
        $this->bank = Bank::findOrFail($this->selectBank);
        // dd($this->bank);
    }

    function getTotal($id)
    {
        $transaksi = TransaksiObat::findOrFail($id);
        $total = 0;
        foreach ($transaksi->detailTransaksi as $key => $value) {
            $total += $value->jumlah*$value->harga_saat_ini;
        }
        return $total;
    }

    function getTanggal($date)
    {
        return Carbon::parse($date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y');
    }

    function getDetail($id)
    {
        $transaksi = TransaksiObat::findOrFail($id);
        $this->detailTransaksi = $transaksi;
        // $this->emitSelf('refreshComponent');
    }

    function bayar($id)
    {
        $transaksi = TransaksiObat::findOrFail($id);
        if ($this->imageUpload instanceof TemporaryUploadedFile) {
            $transaksi->addMedia($this->imageUpload)
                ->toMediaCollection($transaksi::BUKTI_PEMBAYARAN);
        }
        $transaksi->status_pembayaran = 'menunggu konfirmasi';
        $transaksi->save();
        return redirect()->route('pasien.tebus-obat.index')->with('alertType','success')->with('alertMessage','Bukti pembayaran berhasil diperbaharui.');
    }

    public function render()
    {
        return view('pages.pasien.obat.riwayat-obat')
        ->extends('layouts.layout_user')
        ->section('content');
    }
}
