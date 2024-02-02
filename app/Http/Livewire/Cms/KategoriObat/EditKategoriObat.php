<?php

namespace App\Http\Livewire\Cms\KategoriObat;

use Livewire\Component;
use App\Http\Livewire\Cms\KategoriObat\FormKategoriObat;

class EditKategoriObat extends FormKategoriObat
{
    public function mount()
    {
        $this->operation = 'update';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.kategori-obat.edit-kategori-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
