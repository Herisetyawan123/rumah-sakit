<?php

namespace App\Http\Livewire\Cms\Obat;

use Livewire\Component;
use App\Http\Livewire\Cms\Obat\FormObat;
use App\Models\KategoriObat;
use App\Models\Obat;

class CreateObat extends FormObat
{
    public function mount()
    {
        $this->obat = new Obat();
        $this->operation = 'create';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.obat.create-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
