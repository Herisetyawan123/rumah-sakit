<?php

namespace App\Http\Livewire\Cms\KategoriObat;

use Livewire\Component;
use App\Http\Livewire\Cms\KategoriObat\FormKategoriObat;
use App\Models\KategoriObat;

class CreateKategoriObat extends FormKategoriObat
{
    public function mount()
    {
        $this->kategori_obat = new KategoriObat();
        $this->operation = 'create';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.kategori-obat.create-kategori-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
