<?php

namespace App\Http\Livewire\Pasien\Obat;

use Livewire\Component;

class InformasiPasienComponent extends Component
{

    public $formInformasi;
    public $errorInformasiFields = [];
    public function render()
    {
        return view('livewire.pasien.obat.informasi-pasien-component')->extends('layouts.layout_user')
        ->section('content');
    }

    public function checkInformasiPasien(){
        $excludedKeys = ['tinggi', 'berat', 'alergi', 'alamat_tujuan', 'detail_lokasi', 'pengambilan'];
        $emptyKeys = array_keys(array_filter($this->formInformasi, function ($value){
            return $value === '';
        }));
        $filteredEmptyKeys = array_diff($emptyKeys, $excludedKeys);
        $this->errorInformasiFields = $filteredEmptyKeys;
        return count($filteredEmptyKeys) > 0;
    }

    public function nextStep(){
        $this->checkInformasiPasien();
        $this->emit('updatedata', $this->formInformasi);
        $this->emitUp("switchTab", "alamat");
    }
}
