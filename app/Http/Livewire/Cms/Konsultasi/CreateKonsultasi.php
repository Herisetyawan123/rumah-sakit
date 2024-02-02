<?php

namespace App\Http\Livewire\Cms\Konsultasi;


use App\Http\Livewire\Cms\Konsultasi\FormKonsultasi;
use App\Models\Konsultasi;

class CreateKonsultasi extends FormKonsultasi
{
    public function mount()
    {
        $this->konsultasi = new Konsultasi();
        $this->operation = 'create';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.konsultasi.create-konsultasi')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
