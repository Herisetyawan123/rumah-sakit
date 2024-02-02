<?php

namespace App\Http\Livewire\Cms\KategoriObat;

use Livewire\Component;
use App\Http\Livewire\Cms\KategoriObat\FormKategoriObat;

class ShowKategoriObat extends FormKategoriObat
{
    /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {

        $this->operation = 'view';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.kategori-obat.show-kategori-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
