<?php

namespace App\Http\Livewire\Cms\Kasir;

use App\Http\Livewire\Cms\Kasir\FormKasir;
use Livewire\Component;

class ShowKasir extends FormKasir
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
        return view('livewire.cms.kasir.show-kasir')
            ->extends('layouts.cms_layout')
            ->section('main-content');
    }
}
