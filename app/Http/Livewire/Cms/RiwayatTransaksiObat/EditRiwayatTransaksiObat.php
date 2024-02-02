<?php

namespace App\Http\Livewire\Cms\RiwayatTransaksiObat;

use App\Http\Livewire\Cms\TransaksiObat\EditTransaksiObat;
use App\Models\TransaksiObat;
use Livewire\Component;

class EditRiwayatTransaksiObat extends EditTransaksiObat
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
