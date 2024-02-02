<?php

namespace App\Http\Livewire\Cms\Pasien;

use Livewire\Component;
use App\Http\Livewire\Cms\Pasien\FormPasien;

class ShowPasien extends FormPasien
{
    public function mount(){
        $this->operation = 'view';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.pasien.show-pasien')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
