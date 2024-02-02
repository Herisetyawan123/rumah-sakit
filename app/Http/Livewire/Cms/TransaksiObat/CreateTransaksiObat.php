<?php

namespace App\Http\Livewire\Cms\TransaksiObat;

use Livewire\Component;
use App\Models\TransaksiObat;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cms\TransaksiObat\FormTransaksiObat;
use App\Models\ResepNDiagnosa;

class CreateTransaksiObat extends FormTransaksiObat
{


    public function mount(){
        $this->transaksi_obat = new TransaksiObat();
        $this->operation = 'create';

        if (Route::current()->parameter('id')) {
            $diagnosa = ResepNDiagnosa::findOrFail(Route::current()->parameter('id'));
            $this->transaksi_obat->pasien_id = $diagnosa->pasien_id;
        }
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.transaksi-obat.create-transaksi-obat')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
