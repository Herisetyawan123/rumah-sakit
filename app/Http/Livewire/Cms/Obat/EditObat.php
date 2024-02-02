<?php

namespace App\Http\Livewire\Cms\Obat;

use App\Models\Obat;
use Livewire\Component;
use App\Models\KategoriObat;
use App\Http\Livewire\Cms\Obat\FormObat;

class EditObat extends FormObat
{
    public function mount()
    {
        $this->operation = 'update';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.obat.edit-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
