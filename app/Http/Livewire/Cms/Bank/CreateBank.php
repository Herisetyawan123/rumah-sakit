<?php

namespace App\Http\Livewire\Cms\Bank;

use App\Http\Livewire\Cms\Bank\FormBank;
use App\Models\Bank;

class CreateBank extends FormBank
{
    /**
     * Handle the `mount` lifecycle event.
     */
    public function mount(): void
    {
        $this->bank = new Bank();
        $this->operation = 'create';
        parent::mount();
    }

    public function render()
    {
        return view('livewire.cms.bank.create-bank')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
