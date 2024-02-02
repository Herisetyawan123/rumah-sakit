<?php

namespace App\Http\Livewire\Cms\ResepNDiagnosa;

use Livewire\Component;
use App\Http\Livewire\Cms\ResepNDiagnosa\FormResepNDiagnosa;

class ShowResepNDiagnosa extends FormResepNDiagnosa
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
        return view('livewire.cms.resep-n-diagnosa.show-resep-n-diagnosa')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
