<?php

namespace App\Http\Livewire\Cms\TransaksiObat;

use Livewire\Component;

class EditTransaksiObat extends FormTransaksiObat
{
    public function mount(){
        $this->operation = 'update';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.transaksi-obat.edit-transaksi-obat')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
