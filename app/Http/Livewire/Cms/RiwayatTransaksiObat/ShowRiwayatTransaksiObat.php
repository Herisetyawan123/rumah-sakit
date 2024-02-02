<?php

namespace App\Http\Livewire\Cms\RiwayatTransaksiObat;

use Livewire\Component;
use App\Models\TransaksiObat;
use App\Http\Livewire\Cms\TransaksiObat\ShowTransaksiObat;

class ShowRiwayatTransaksiObat extends ShowTransaksiObat
{
    public $riwayat_transaksi_obat;
    public function backToIndex()
    {
        return redirect(route('cms.riwayat-transaksi-obat.index'));
    }

    public function mount(){
        $this->transaksi_obat = TransaksiObat::findOrFail($this->riwayat_transaksi_obat);
        parent::mount();
    }
}
