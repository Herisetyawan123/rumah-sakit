<?php

namespace App\Http\Livewire\Cms\Obat;

use Livewire\Component;
use App\Models\KategoriObat;
use App\Http\Livewire\Cms\Obat\FormObat;

class ShowObat extends FormObat
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
        return view('livewire.cms.obat.show-obat')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
