<?php

namespace App\Http\Livewire\Cms\Bank;

use Livewire\Component;
use App\Http\Livewire\Cms\Bank\FormBank;

class ShowBank extends FormBank
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
        return view('livewire.cms.bank.show-bank')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
