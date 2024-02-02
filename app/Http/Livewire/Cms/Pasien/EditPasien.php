<?php

namespace App\Http\Livewire\Cms\Pasien;

use Livewire\Component;
use App\Http\Livewire\Cms\Pasien\FormPasien;

class EditPasien extends FormPasien
{
    public function mount(){
        $this->operation = 'update';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.pasien.edit-pasien')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
