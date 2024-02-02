<?php

namespace App\Http\Livewire\Dokter\ResepNDiagnosa;

use Livewire\Component;
use App\Http\Livewire\Dokter\ResepNDiagnosa\FormResepNDiagnosa;

class EditResepNDiagnosa extends FormResepNDiagnosa
{
    public function mount(){
        $this->operation = 'update';
        // dd($this->kode_transaksi);
        parent::mount();
    }
    
    
    public function render()
    {
        
        return view('livewire.dokter.resep-n-diagnosa.edit-resep-n-diagnosa')
        ->extends('layouts.layout_dokter')
        ->section('main-content');
    }
}
