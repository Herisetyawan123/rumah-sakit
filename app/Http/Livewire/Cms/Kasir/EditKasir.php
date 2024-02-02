<?php

namespace App\Http\Livewire\Cms\Kasir;

use Livewire\Component;
use App\Http\Livewire\Cms\Admin\FormAdmin;
use App\Http\Livewire\Cms\Kasir\FormKasir;
use App\Models\Admin;

class EditKasir extends FormKasir
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
        return view('livewire.cms.kasir.edit-kasir')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
