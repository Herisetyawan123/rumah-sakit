<?php

namespace App\Http\Livewire\Cms\ResepNDiagnosa;

use Livewire\Component;
use App\Http\Livewire\Cms\ResepNDiagnosa\FormResepNDiagnosa;

class EditResepNDiagnosa extends FormResepNDiagnosa
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
        return view('livewire.cms.resep-n-diagnosa.edit-resep-n-diagnosa')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
