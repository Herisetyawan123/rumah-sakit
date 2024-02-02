<?php

namespace App\Http\Livewire\Cms\Pasien;

use Livewire\Component;
use App\Http\Livewire\Cms\Pasien\FormPasien;
use App\Models\Pasien;

class CreatePasien extends FormPasien
{
    public function mount(){
        $this->pasien = new Pasien();
        $this->operation = 'create';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.pasien.create-pasien')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
