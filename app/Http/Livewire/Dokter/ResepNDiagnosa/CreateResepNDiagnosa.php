<?php

namespace App\Http\Livewire\Dokter\ResepNDiagnosa;


use App\Models\ResepNDiagnosa;
use App\Http\Livewire\Dokter\ResepNDiagnosa\FormResepNDiagnosa;

class CreateResepNDiagnosa extends FormResepNDiagnosa
{
    public function mount(){
        $this->resep_n_diagnosa = new ResepNDiagnosa();
        $this->operation = 'create';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.dokter.resep-n-diagnosa.create-resep-n-diagnosa')
        ->extends('layouts.layout_dokter')
        ->section('main-content');
    }
}
