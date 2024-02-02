<?php

namespace App\Http\Livewire\Cms\Konsultasi;

use Livewire\Component;
use App\Http\Livewire\Cms\Konsultasi\FormKonsultasi;

class EditKonsultasi extends FormKonsultasi
{
    public function mount()
    {
        $this->operation = 'update';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.konsultasi.edit-konsultasi')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
