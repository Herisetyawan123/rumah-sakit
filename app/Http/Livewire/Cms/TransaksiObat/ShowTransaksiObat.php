<?php

namespace App\Http\Livewire\Cms\TransaksiObat;

use Livewire\Component;
use App\Http\Livewire\Cms\TransaksiObat\FormTransaksiObat;

class ShowTransaksiObat extends FormTransaksiObat
{
    public function mount(){
        $this->operation = 'update';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.transaksi-obat.show-transaksi-obat')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
