<?php

namespace App\Http\Livewire\Dokter\Konsultasi;

use Livewire\Component;

class ShowKonsultasi extends FormKonsultasi
{
    public function mount(){
        $this->operation = 'view';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.dokter.konsultasi.show-konsultasi')
        ->extends('layouts.layout_dokter')
        ->section('main-content');
    }
}
