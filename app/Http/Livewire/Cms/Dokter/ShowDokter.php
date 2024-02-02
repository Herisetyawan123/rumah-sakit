<?php

namespace App\Http\Livewire\Cms\Dokter;

use Livewire\Component;
use App\Http\Livewire\Cms\Dokter\FormDokter;

class ShowDokter extends FormDokter
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
        return view('livewire.cms.dokter.show-dokter')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
