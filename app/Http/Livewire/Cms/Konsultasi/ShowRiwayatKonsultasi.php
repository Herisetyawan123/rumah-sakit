<?php

namespace App\Http\Livewire\Cms\Konsultasi;

use Livewire\Component;
use App\Http\Livewire\Cms\Konsultasi\FormKonsultasi;

class ShowRiwayatKonsultasi extends FormKonsultasi
{
    public function mount()
    {
        $this->operation = 'view';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.konsultasi.show-riwayat-konsultasi')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
