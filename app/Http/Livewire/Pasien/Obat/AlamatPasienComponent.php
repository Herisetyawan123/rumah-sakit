<?php

namespace App\Http\Livewire\Pasien\Obat;

use Livewire\Component;

class AlamatPasienComponent extends Component
{
    public $formInformasi;

    public function render()
    {
        return view('livewire.pasien.obat.alamat-pasien-component');
    }

    
    public function backStep(){
        return $this->emitUp("switchTab", "informasi");
    }

    public function nextStep(){
        $this->emit('updatedata', $this->formInformasi);
        return $this->emitUp("submitObat");
    }
}
