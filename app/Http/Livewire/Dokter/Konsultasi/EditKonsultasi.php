<?php

namespace App\Http\Livewire\Dokter\Konsultasi;

use Livewire\Component;
use App\Http\Livewire\Dokter\Konsultasi\FormKonsultasi;

class EditKonsultasi extends FormKonsultasi
{
    public function mount(){
        $this->operation = 'update';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.dokter.konsultasi.edit-konsultasi')
        ->extends('layouts.layout_dokter')
        ->section('main-content');
    }
}
