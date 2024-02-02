<?php

namespace App\Http\Livewire\Cms\Role;

use Livewire\Component;
use App\Http\Livewire\Cms\Role\FormRole;

class EditRole extends FormRole
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
        return view('livewire.cms.roles.edit-role')
        ->extends('layouts.cms_layout')
        ->section('main-content');
    }
}
