<?php

namespace App\Http\Livewire\Dokter\ResepNDiagnosa;

use Livewire\Component;
use App\Http\Livewire\Dokter\ResepNDiagnosa\FormResepNDiagnosa;

class ShowResepNDiagnosa extends FormResepNDiagnosa
{
    public function mount(){
        $this->operation = 'view';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.dokter.resep-n-diagnosa.show-resep-n-diagnosa')
        ->extends('layouts.layout_dokter')
        ->section('main-content');
    }
}
