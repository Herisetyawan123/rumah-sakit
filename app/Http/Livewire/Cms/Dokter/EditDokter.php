<?php

namespace App\Http\Livewire\Cms\Dokter;

use Livewire\Component;
use App\Http\Livewire\Cms\Dokter\FormDokter;

class EditDokter extends FormDokter
{
    /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        $this->operation = 'update';
        parent::mount();
    }
    public function render()
    {
        return view('livewire.cms.dokter.edit-dokter')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
